<?php

class staruser extends basecontroller
{
    public function __construct()
    {
        parent::__construct();
        $this->seo_title('达人秀');
    }
    public function index()
    {
        $num_per_page = 10;
        $ptx_staruser = spClass("ptx_staruser");
        if ($this->category_id)
        {
            $conditions['category_id'] = $this->category_id;
            $args['cat'] = $this->category_id;
        }
        $starusers = $ptx_staruser->search($conditions, $this->page, $num_per_page);
        $this->pages = createTPages($ptx_staruser->spPager()->getPager(), 'staruser', 'index', $conditions);
        $this->prepareView($starusers);
        $this->ouput("/staruser/index.php");
    }
    public function apply()
    {
        $this->ajax_check_login();
        if ($this->txt && $this->category_id)
        {
            $ptx_apply = spClass("ptx_apply");
            $ptx_staruser = spClass("ptx_staruser");
            if ($ptx_staruser->check_exits($this->current_user['user_id']))
            {
                ajax_failed_response(T('already_staruser_failed'));
                return;
            }
            if ($ptx_apply->check_exits($this->current_user['user_id'], 1))
            {
                ajax_failed_response(T('already_applied'));
                return;
            }
            $ptx_apply->add_starapply($this->current_user['user_id'], $this->category_id, $this->txt);
            ajax_success_response(null, T('apply_succeed'));
            return;
        }
        ajax_failed_response();
    }
    private function prepareView($starusers)
    {
        $user_id = $this->is_login()?$this->current_user['user_id']:0;
        foreach ($starusers as $key => $star)
        {
            $star['star_cover'] = str_to_arr($star['star_cover']);
            $style = $star['star_cover']['style']?$star['star_cover']['style']:'star_1';
            $this->staruser = $star;
            $starusers[$key]['star_view'] = $this->render('/common/' . $style . '.php');
            $starusers[$key]['relation_view'] = $this->relationView($user_id, $star['user_id']);
        }
        $this->starusers = $starusers;
    }
    public function save_staruser()
    {
        $this->ajax_check_editer();
        $star_reason = $this->spArgs("sreason");
        if (!$this->category_id || !$this->user_id || !$star_reason)
        {
            $response = array('success' => false, 'message' => T('illegal_operation'));
            echo json_encode($response);
            return;
        }
        $ptx_staruser = spClass("ptx_staruser");
        $data['user_id'] = $this->user_id;
        $data['category_id'] = $this->category_id;
        $data['star_reason'] = $star_reason;
        $conditions['user_id'] = $this->user_id;
        $conditions['category_id'] = $this->category_id;
        $staruser = $ptx_staruser->find_one($conditions);
        if (!$staruser)
        {
            $ptx_staruser->add_one($data);
            $ptx_user = spClass("ptx_user");
            $ptx_user->update_staruser($this->user_id, 1);
        }
        else
        {
            $ptx_staruser->update($conditions, $data);
        }
        $ptx_staruser->update_staruser_cache();
        $response = array('success' => true);
        echo json_encode($response);
        return;
    }
    public function get_staruser()
    {
        $this->ajax_check_login();
        if (!$this->category_id || !$this->user_id || (!$this->is_editer() && !$this->current_user['is_star']))
        {
            $response = array('success' => false, 'message' => T('illegal_operation'));
            echo json_encode($response);
            return;
        }
        $ptx_staruser = spClass("ptx_staruser");
        $condition['user_id'] = $this->user_id;
        $staruser = $ptx_staruser->find_one($condition);
        if ($staruser)
        {
            $ptx_share = spClass("ptx_share");
            $share = $ptx_share->find_one(array('share_id' => $this->share_id), NULL, 'share_id,detail.image_path');
            $staruser['avatar'] = useravatar($this->user_id, 'large');
            $staruser['star_cover'] = str_to_arr($staruser['star_cover']);
            $staruser['home'] = spUrl('pub', 'index', array('uid' => $staruser['user_id']));
            $staruser['image_path'] = base_url() . $share['image_path'] . '_middle.jpg';
            $response = array('success' => true, 'data' => $staruser);
            echo json_encode($response);
            return;
        }
        else
        {
            $ptx_user = spClass("ptx_user");
            $user = $ptx_user->getuser_byid($this->user_id);
            $staruser['user_id'] = $this->user_id;
            $staruser['home'] = spUrl('pub', 'index', array('uid' => $staruser['user_id']));
            $staruser['nickname'] = $user['nickname'];
            $ptx_category = spClass("ptx_category");
            $category = $ptx_category->find_one(array('category_id' => $this->category_id));
            $staruser['category_id'] = $this->category_id;
            $staruser['category_name_cn'] = $category['category_name_cn'];
            $staruser['avatar'] = useravatar($this->user_id, 'large');
            $response = array('success' => false, 'data' => $staruser);
            echo json_encode($response);
            return;
        }
    }
    public function crop_staruser_cover()
    {
        $this->ajax_check_login();
        if (!$this->category_id || !$this->share_id || !$this->user_id || (!$this->is_editer() && !$this->current_user['is_star']))
        {
            $response = array('success' => false, 'message' => T('illegal_operation'));
            echo json_encode($response);
            return;
        }
        if (!$this->user_id || !$this->share_id || !$this->category_id)
        {
            $response = array('success' => false, 'message' => T('illegal_operation'));
            echo json_encode($response);
            return;
        }
        $position = $this->spArgs("position");
        $x = $this->spArgs("x");
        $y = $this->spArgs("y");
        $w = $this->spArgs("w");
        $h = $this->spArgs("h");
        $js_w = $this->spArgs("js_w");
        $js_h = $this->spArgs("js_h");
        $ww = $this->spArgs("ww");
        $hh = $this->spArgs("hh");
        $style = $this->spArgs("sy", 'star_1');
        $ptx_share = spClass('ptx_share');
        $share = $ptx_share->findJoin(array('share_id' => $this->share_id), null, 'image_path');
        if ($share)
        {
            $imagelib = spClass("ImageLib");
            $imagepath = APP_PATH . $share['image_path'];
            $image_size = getimagesize($imagepath . '_large.jpg');
            $weight = $image_size[0];
            $height = $image_size[1];
            if ($js_w < $weight)
            {
                $scale = $js_w / $weight;
            }elseif ($js_h < $height)
            {
                $scale = $js_h / $height;
            }
            else
            {
                $scale = 1;
            }
            $x = $x / $scale;
            $y = $y / $scale;
            $w = $w / $scale;
            $h = $h / $scale;
            $imagelib->crop_image($imagepath . '_large.jpg', $imagepath . '_star.jpg', $x, $y, $w, $h);
            $imagelib->create_thumb($imagepath . '_star.jpg', NULL, $ww, $hh, $imagepath . '_star.jpg');
        }
        $ptx_staruser = spClass("ptx_staruser");
        $condition['user_id'] = $this->user_id;
        $staruser = $ptx_staruser->find_one($condition);
        if ($staruser)
        {
            $covers = str_to_arr($staruser['star_cover']);
            $covers['style'] = $style;
            $covers['s' . $position . '_sid'] = $this->share_id;
            $covers['s' . $position . '_image_path'] = $share['image_path'];
            $star_cover = array_to_str($covers);
            $ptx_staruser->update($condition, array('star_cover' => $star_cover));
            $ptx_staruser->update_staruser_cache();
            $data['img'] = base_url() . $share['image_path'] . '_star.jpg?' . uniqid();
            $response = array('success' => true, 'message' => T('operate_succeed'), 'data' => $data);
            echo json_encode($response);
            return;
        }
        $response = array('success' => false, 'message' => T('operate_failed'));
        echo json_encode($response);
        return;
    }
}
?>