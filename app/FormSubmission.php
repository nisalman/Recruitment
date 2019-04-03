<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Form;
use \ Carbon\Carbon;
class FormSubmission extends Model
{
	protected $fillable = ['birth'];

    public function attachments()
    {
    	return $this->morphMany(Document::class, 'documentable');
    }

    public function testattachments()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

	public static function boot()
	{
		parent::boot();
        static::observe(\App\Observers\FormSubmissionObserver::class);
	}

	public function upazila()
	{
		return $this->belongsTo(Upazila::class, 'permenentThana');
	}


	public function PresentUpazila()
	{
		return $this->belongsTo(Upazila::class, 'currentThana');
	}


//	public function getPhotoAttribute($photo)
//	{
//		if(!$photo)
//		{
//			return "https://www.fanspole.com/assets/default_user-c283cfbc3d432e22b1d2f1eef515d0b9.png";
//		}
//		return \Storage::url($photo);
//	}


	public function getSportNameAttribute()
	{
		if($sport = $this->sport)
		{
			return $sport->name;
		}
		return null;
	}

	public function sport()
	{
		return $this->belongsTo(Sport::class);
	}

    public function getPlayerLevelNameAttribute()
    {
        if($sport = $this->playerLevel)
        {
            return $sport->name;
        }
        return null;
    }

    public function playerLevel()
    {
        return $this->belongsTo(PlayerLebel::class);
    }


    public function getBirthAttribute($value)
	{
		return toBangla(date("d-m-Y", strtotime($value)));
	}

    public function getDeathAttribute($value)
    {
        return toBangla($value);
    }

	public function getNIDAttribute($value)
	{
		return toBangla($value);
	}

	public function achievementsAsHtml()
	{
		$html = "";
		foreach ($this->attachments()->where('type', 'award')->get() as $award) {
			$html .= "<i data-src='".$award->src."' class='fa fa-trophy golden' title='".$award->title."'> </i>";
		}
        foreach ($this->testattachments()->where('type', 'award')->get() as $test) {
            $html .= "<i data-src='".$test->src."' class='fa fa-trophy golden' title='".$test->title."'> </i>";
        }
		return $html;
	}

	public function getRatingAttribute($rating)
	{
		if(!$rating)
		{
			$rating = 0;
		}
		return $rating;
	}

	public function priorityAsHtml()
	{
		$html = "";
		// for ($i = 0; $i < 5; $i++) {
		// 	$html .= "<i class='fa fa-star ";
		// 	if($i < $this->rating)
		// 	{
		// 		$html .="gold";
		// 	}
		// 	$html.="'></i>";
		// }
		$html .= '  <div id="rateYo'.$this->id.'"></div>
  <script>
  $("#rateYo'.$this->id.'").rateYo({
    starWidth: "15px"
 
});
  </script>';
		return $html;
	}

	public function setBirthAttribute($birth)
	{
		$date =  new Carbon(toEnglish($birth));
		return $this->attributes['birth'] =  $date->format('Y-m-d');
	}	

	public function setDeathAttribute($birth)
	{
		$date =  new Carbon(toEnglish($birth));
		return $this->attributes['death'] =  $date->format('Y-m-d');
	}	

	public function getNIDCopyAttribute($value)
	{
		return $value?\Storage::url($value):"https://pbs.twimg.com/profile_images/600060188872155136/st4Sp6Aw.jpg";
	}


	public function scopeNSC()
	{
		//return $this->where('to', 'nsc');
		return $this->whereIn('status', [0, 1, 2, 3, 4])->where('is_federation',1);

	}

	public function scopeMinistry()
	{
		return $this->whereIn('status', [0, 1, 2, 3, 4]);
	}

	public function scopeBSC()
	{
		return $this->whereIn('status', [0, 1, 2, 3, 4]);
	}

	public function scopeDC()
	{
		return $this->whereIn('id',  request()->user()->location->submissions->pluck('id'))->where('is_federation',0);
	}

    public function scopeSPECIAL()
    {
        return $this->where('status', 5);
    }



}
