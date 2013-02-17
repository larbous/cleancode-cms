<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Admin_Controller {

  //--------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();

    $this->auth->restrict('Analytics.Settings.View');
    $this->lang->load('analytics');

    Assets::add_js($this->load->view('settings/js', null, true), 'inline');

    $settings = array (
      'ga_username' => settings_item('ga.username'),
      'ga_password' => settings_item('ga.password'),
      'ga_enabled'  => (int) settings_item('ga.enabled'),
      'ga_profile'  => settings_item('ga.profile'),
      'ga_code'     => settings_item('ga.code')
      );

    Template::set('settings',$settings);
  }

  //--------------------------------------------------------------------

  /*
    Method: index()

    Displays a list of form data.
  */
  public function index()
  {
    if ($this->input->post('submit'))
    {
      if ($this->save_settings())
      {
        Template::set_message('<h4 class="alert-heading"><i class="icon-remove"> </i> '.lang('settings_edit_success').'</h4>', 'success');
        Template::redirect('admin/settings/analytics');
      } else {
        Template::set_message('<h4 class="alert-heading"><i class="icon-remove"> </i> Error saving form. <br />'.$error.'</hr>', 'error');
      }
    }

    Template::set('toolbar_title','Google Analytics');
    Template::render();
  }

  //--------------------------------------------------------------------

  /*
    Method: edit()

    Displays form data and writes settings to database.
  */
  public function edit()
  {
    if ($this->input->post('submit'))
    {
      if ($this->save_settings())
      {
        Template::set_message(lang('settings_edit_success'), 'success');
        Template::redirect('admin/settings/analytics');
      } else {
        Template::set_message('Error', 'error');
      }
    }

    Template::set('toolbar_title', "Google Analytics");
    Template::set_view('settings/index');
    Template::render();
  }

  //--------------------------------------------------------------------

  //--------------------------------------------------------------------
  // !PRIVATE METHODS
  //--------------------------------------------------------------------

  /*
    Method: save_settings()

    Runs form validation on data and writes settings to database.
  */
  private function save_settings()
  {

    $this->form_validation->set_rules('ga_username','Username','valid_email|required|trim|xss_clean|max_length[100]');

    $rule = '';
    if ($this->input->post('ga_new_password'))
    {
      $rule = 'required|';
    }

    $this->form_validation->set_rules('ga_new_password','Password',$rule.'trim|xss_clean|max_length[100]');

    $this->form_validation->set_rules('ga_enabled','Enabled','required|trim|xss_clean|max_length[1]');

    $rule = '';
    if ($this->input->post('ga_enabled') != 0)
    {
      $rule = 'required|';
    }


    $this->form_validation->set_rules('ga_profile','Profile id','trim|xss_clean|max_length[100]');
    $this->form_validation->set_rules('ga_code','Code',$rule.'trim|xss_clean|max_length[15]');

    if ($this->form_validation->run() === FALSE)
    {
      return FALSE;
    }



    if ($this->input->post('ga_new_password'))
    {
      $password = $this->input->post('ga_new_password');
      $q = $this->settings_lib->set('ga.password', $password, 'analytics');

      if ($q === false) return false;
    }

    $q = $this->settings_lib->set('ga.username', $this->input->post('ga_username'), 'analytics');
    if ($q === false) return false;

    $q = $this->settings_lib->set('ga.enabled', $this->input->post('ga_enabled'), 'analytics');
    if ($q === false) return false;

    $q = $this->settings_lib->set('ga.profile', $this->input->post('ga_profile'), 'analytics');
    if ($q === false) return false;

    $q = $this->settings_lib->set('ga.code', $this->input->post('ga_code'), 'analytics');
    if ($q === false) return false;

    //destroy the saved update message in case they changed update preferences.
    if ($this->cache->get('update_message'))
    {
      $this->cache->delete('update_message');
    }

    // Log the activity
    $this->activity_model->log_activity($this->current_user->id, lang('bf_act_settings_saved'). $this->input->ip_address(), 'analytics');

    return true;
  }

  //--------------------------------------------------------------------

}
