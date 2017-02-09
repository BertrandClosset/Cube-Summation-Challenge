<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cube_Controller extends CI_Controller {

  /**
  * Index Page for this controller.
  *
  * Maps to the following URL
  * 		http://example.com/index.php/welcome
  *	- or -
  * 		http://example.com/index.php/welcome/index
  *	- or -
  * Since this controller is set as the default controller in
  * config/routes.php, it's displayed at http://example.com/
  *
  * So any other public methods not prefixed with an underscore will
  * map to /index.php/welcome/<method_name>
  * @see https://codeigniter.com/user_guide/general/urls.html
  */
  public function __construct(){
    parent::__construct();
    $this->load->library('javascript');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->helper('url');
  }
  public function index()
  {
    $data["output"] = "";
    $this->load->view('index',$data);

  }
  public function calculCube(){
    $this->load->library('form_validation');
    $nb_tests = $this->input->post("nb-tests");
    $tests = $this->input->post("tests");
    $data['tests'] = $tests;
    $this->form_validation->set_rules('nb-tests', 'Number of testcases', 'callback_nb_tests_check');
    $this->form_validation->set_rules('tests', 'Tests', 'required|callback_number_cases_check');
    $status = $this->form_validation->run();
    $this->form_validation->set_rules('tests', 'Tests', 'callback_number_instructions_check');
    $data['tests'] = $tests;
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('index');
    }
    else
    {
      $j = 0;
      $instructions = $this->split_multidimensionnal_array($tests);
      foreach ($instructions as &$test) {
        $first_line = $test[0];
        list($n, $m) = explode(" ", $first_line, 2);
        $this->load->model('cube');
        $this->cube->setN($n);
        $this->cube->setMatrix($n);
        for($i = 1; $i < count($test); $i++) {
          if($test[$i][0] == 'U'){
            $test[$i] = list($function, $x, $y, $z, $w) = explode(" ", $test[$i], 5);
            if (($x > $n) || ($y > $n) || ($z > $n)) {
              $this->session->set_flashdata('message', 'The coordinates x, y, z must be between 1 and n');
              redirect("Cube_Controller/index");
            }
            elseif (($w < -1000000000) || ($w > 1000000000))
            {
              $this->session->set_flashdata('message', 'The value of a point must be between -10 ^ 9 and 10 ^ 9');
              redirect("Cube_Controller/index");
            }
            else{
              $this->cube->update($x,$y,$z,$w);
            }


          }
          if($test[$i][0] == 'Q'){
            $test[$i] = list($function, $x1, $y1, $z1, $x2, $y2, $z2) = explode(" ", $test[$i], 7);
            if ($x1 > $x2 || $y1 > $y2 || $z1 > $z2){
              $this->session->set_flashdata('message', 'The coordinates x1, y1 and z1 must be less than x2, y2 and z2');
              redirect("Cube_Controller/index");
            }
            if (($x1 > $n) || ($x1 < 1)){
              $this->session->set_flashdata('message', 'The coordinate x1 must be between 1 and n');
              redirect("Cube_Controller/index");
            }
            if (($y1 > $n) || ($y1 < 1)){
              $this->session->set_flashdata('message', 'The coordinate y1 must be between 1 and n');
              redirect("Cube_Controller/index");
            }
            if (($z1 > $n) || ($z1 < 1)){
              $this->session->set_flashdata('message', 'The coordinate z1 must be between 1 and n');
              redirect("Cube_Controller/index");
            }
            if (($x2 > $n) || ($x2 < 1)){
              $this->session->set_flashdata('message', 'The coordinate x2 must be between 1 and n');
              redirect("Cube_Controller/index");
            }
            if (($y2 > $n) || ($y2 < 1)){
              $this->session->set_flashdata('message', 'The coordinate y2 must be between 1 and n');
              redirect("Cube_Controller/index");
            }
            if (($z2 > $n) || ($z2 < 1)){
              $this->session->set_flashdata('message', 'The coordinate z2 must be between 1 and n');
              redirect("Cube_Controller/index");
            }
            $result = $this->cube->query($x1,$y1,$z1,$x2,$y2,$z2);
            $tab_result[$j] = $result;
            $j++;

          }

        }

      }
      $data['output'] = $tab_result;

      $this->load->view('index',$data);
    }
  }

  /**
  * Verify if the quantity of the test case is between 1 & 50
  *
  * @param       int  $num
  * @return      boolean
  */
  public function nb_tests_check($num)
  {
    if ($num > 50 || $num < 1)
    {
      $this->form_validation->set_message('nb_tests_check','The number of testcases must be between 1 and 50');
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }

  /**
  * Verify if in we have the right number of testcase
  *
  * @param       string  $str
  * @return      boolean
  */
  public function number_cases_check($str)
  {
    $array = $this->split_multidimensionnal_array($str);
    $nb_cases = count($array);
    if ($nb_cases != $this->input->post("nb-tests")){
      $this->form_validation->set_message('number_cases_check', 'The quantity of testcases must be equal to the number entered before');
      return FALSE;
    }
    else{
      return TRUE;
    }

  }

  /**
  * Verify if in which testcase, we have the right number of instructions
  *
  * @param       string  $str
  * @return      boolean
  */
  public function number_instructions_check($str)
  {
    $array = $this->split_multidimensionnal_array($str);
    $nb_cases = count($array);
    foreach ($array as &$sub_array) {
      $first_line = $sub_array[0];
      list($n, $m) = explode(" ", $first_line, 2);
      if ($m != (count($sub_array)-1)){
        $this->form_validation->set_message('number_instructions_check', 'The quantity of instructions must be equal to the number M');
        return FALSE;
      }
      if ($m > 1000 || $m < 1){
        $this->form_validation->set_message('number_instructions_check', 'The number of instructions must be between 1 and 1000');
        return FALSE;
      }
      if ($n > 100 || $n < 1){
        $this->form_validation->set_message('number_instructions_check', 'The size of the matrice must be between 1 and 100');
        return FALSE;
      }
    }
    return TRUE;
  }

  /**
  * Format the textarea data in a multidimensional array
  *
  * @param       string  $str
  * @return      array   $array
  */
  public function split_multidimensionnal_array($str){
    $tmp = explode("\r\n", trim($str));
    $n = 1;
    $x = 1;
    $y = 0;
    foreach ($tmp as &$value) {
      if (ctype_digit($value[0])) {
        if ($n == 1){
          $array[$x][$y]=$value;
        }
        else{
          $x++;
          $y = 0;
          $array[$x][$y]=$value;
        }
      }
      else{
        $array[$x][$y]=$value;
      }
      $y++;
      $n++;
    }
    return $array;
  }

}
?>
