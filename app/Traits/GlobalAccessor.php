<?php 
namespace App\Traits;
use \Form;
use \Html;
trait GlobalAccessor
{
	public function getEditableNameAttribute()
	{
		return $this->editableInputHtml('name', $this->name);
	}

	public function getEditableStatusAttribute()
	{
		return $this->editableStatusHtml('status', $this->status);
	}

	public function getEditableSportAttribute()
	{
		return $this->editableSportHtml('sport_id', $this->sport_id);
	}

    public function getEditableFederationAttribute()
    {
        return $this->editableFederationHtml('federation_id', $this->federation_id);
    }

    public function getEditableEstablishedAttribute()
	{
		return $this->editableEstablishedHtml('established', $this->established);
	}

	public function editable($attribute)
	{
		return $this->editableInputHtml($attribute, $this->{$attribute});
	}

	public static function established()
	{
		return [
			'2017' => '২০১৭',
			'2016' => '২০১৬',
		];
	}

	public function rolesAsHtml()
	{
		$html = "";
		foreach ($this->roles as $role) {
			$html .= Form::label($role->name, null, ['class'=> 'label label-primary label-xs']); 
		}
		return $html;
	}


	public function editableEstablishedHtml($name, $established)
	{
		$label = Form::label($established, null, ['class'=> 'showing']);
		$select = Form::select($name, \App\Club::established(), $established, ['class'=>'editing'] );
		return $label.$select;
	}

	public static function asSelect($selected=false, $attr=false)
	{
		$name =  strtolower(class_basename(get_called_class ())).'_id';
		$data = static::all();
		$array = [];
		foreach ($data as  $value) {
			$array[$value->id] = $value->name;
		}
		return \Form::select($name, $array, $selected, $attr);
	}


	public function editableInputHtml($name, $value)
	{
		return '	
			<span class="showing">'.$value.'</span>
			<input type="text"  id="'.$this->id.'_'.$name.'" name="'.$value.'" value="'.$value.'" class="editing">	
		';
	}

	public function editableStatusHtml($name, $value)
	{
		$class = $value==1?"success":"danger";
		$title = $value==1?"সক্রিয়":"নিষ্ক্রিয়";
		$html =  '	
			<span class="showing label label-'.$class.'">'.$title.'</span>
			<select class="editing" name="'.$name.'" id="'.$this->id.'_'.$name.'">';


		$html.='
				<option value="1"';
		$html.=$value==1?"selected":"";
		$html.='>সক্রিয়</option>
				<option value="0"';
		$html.= $value==0?"selected":"";
		$html.= '>নিষ্ক্রিয়</option>
			</select>	
		';
		return $html;
	}



	public function editableSportHtml($name, $value)
	{
		$n = $this->sport->name;
		$label = Form::label($n, $n, ['class'=> 'showing']);
		$html = \App\Sport::asSelect($value, ['class' => 'editing', 'id' => $this->id.'_'.$name, 'name' => $name ]);
		return $label.$html;
		$class = $value==1?"success":"danger";
		$title = $value==1?"সক্রিয়":"নিষ্ক্রিয়";
		$html =  '	
			<span class="showing label label-'.$class.'">'.$title.'</span>
			<select class="editing" name="'.$name.'" id="'.$this->id.'_'.$name.'">
				<option value="1"';
		$html.=$value==1?"selected":"";
		$html.='>সক্রিয়</option>
				<option value="0"';
		$html.= $value==0?"selected":"";
		$html.= '>নিষ্ক্রিয়</option>
			</select>	
		';

		return $html;
	}


    public function editableFederationHtml($name, $value)
    {
        $n = $this->federation->name;
        $label = Form::label($n, $n, ['class'=> 'showing']);
        $html = \App\Federation::asSelect($value, ['class' => 'editing', 'id' => $this->id.'_'.$name, 'name' => $name ]);
        return $label.$html;
        $class = $value==1?"success":"danger";
        $title = $value==1?"সক্রিয়":"নিষ্ক্রিয়";
        $html =  '	
			<span class="showing label label-'.$class.'">'.$title.'</span>
			<select class="editing" name="'.$name.'" id="'.$this->id.'_'.$name.'">
				<option value="1"';
        $html.=$value==1?"selected":"";
        $html.='>সক্রিয়</option>
				<option value="0"';
        $html.= $value==0?"selected":"";
        $html.= '>নিষ্ক্রিয়</option>
			</select>	
		';

        return $html;
    }

}