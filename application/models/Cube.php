<?php

Class Cube extends CI_Model{

public $n;
public $matrix;

 public function __construct()
        {
          parent::__construct();
        }

public function creationMatrice($n){

	for ($x = 1; $x <= $n; $x++)
	{
		for($y = 1; $y <= $n; $y++)
		{
			for($z = 1; $z <= $n; $z++)
			{
				$this->matrix[$x][$y][$z] = 0;
			}
		}
	}
}

public function update($x,$y,$z,$value){

	$this->matrix[$x][$y][$z] = $value;
}

public function query($x1,$y1,$z1,$x2,$y2,$z2){
	$result = 0;
		for ($x = $x1; $x <= $x2; $x++)
	{
		for($y = $y1; $y <= $y2; $y++)
		{
			for($z = $z1; $z <= $z2; $z++)
			{
				$result = $result + $this->matrix[$x][$y][$z];
			}
		}
	}
	return $result;

}

    public function getMatrix()
    {
        return $this->matrix;
    }
    public function getN()
    {
        return $this->n;
    }
    public function setMatrix($n)
    {
      //$this->matrice = $this->creationMatrice($n);
      for ($x = 1; $x <= $n; $x++)
      {
        for($y = 1; $y <= $n; $y++)
        {
          for($z = 1; $z <= $n; $z++)
          {
            $this->matrix[$x][$y][$z] = 0;
          }
        }
      }

    }
    public function setN($n)
    {
        $this->n = $n;
    }


}
?>
