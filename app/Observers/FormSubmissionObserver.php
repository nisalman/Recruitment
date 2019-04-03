<?php

namespace App\Observers;

class FormSubmissionObserver
{

    public function updating($form)
    {
    	$form->modifier = request()->user()->id;
    }

}