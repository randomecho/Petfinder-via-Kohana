<?php  defined('SYSPATH') or die('No direct script access.');

$output = '';

$current_pet = $pet;

$output .= '<div class="petinfo">';
$output .= '<h1>'.$current_pet->name.$status_heading.'</h1>';

$thumbnail = $current_pet->media->photos->photo[0];
$output .= HTML::image($thumbnail, array('title' => $current_pet->name));

$output .= '<div class="petfinderStats">';

$output .= '<div class="petfinderInfo">';
$output .= $current_pet->description;
$output .= '</div>';

$output .= '<dl class="petfinderBio">';
$output .= '<dt class="petfinderBioLabel">Petfinder ID</dt><dd class="petfinderBioData">'.$current_pet->id.'</dd>';
$output .= '<dt class="petfinderBioLabel">Age</dt><dd class="petfinderBioData">'.$current_pet->age.'</dd>';

$output .= '<dt class="petfinderBioLabel">Sex</dt><dd class="petfinderBioData">'.$legend_sex.'</dd>';

$output .= '<dt class="petfinderBioLabel">Breed</dt><dd class="petfinderBioData">';

if($current_pet->mix == 'yes')
	$output .= 'Mix of ';

foreach($current_pet->breeds->breed as $pet_breed)
{
	$output .= $pet_breed.', ';
}

$output .= '</dd>';

if(isset($options))
{
	$output .= '<dt class="petfinderBioLabel">Details</dt><dd class="petfinderBioData">';
	foreach($options as $pet_data)
	{
		$output .= $pet_data.', ';
	}
	$output .= '</dd>';
}

if($current_pet->status == 'A')
{
	$output .= '<dt class="petfinderBioLabel">Contact</dt>';

	$name_contact = ($current_pet->contact->name != '') ? $current_pet->contact->name : 'Contact us';

	if($current_pet->contact->email != '')
		$output .= '<dd class="petfinderBioData">'.HTML::mailto($current_pet->contact->email.'?subject=Petfinder: '.$current_pet->name, $name_contact).'</dd>';
	else
		$output .= '<dd class="petfinderBioData">'.HTML::anchor('http://www.petfinder.com/petdetail/'.$current_pet->id, 'See contact details on Petfinder').'</dd>';
}

$output .= '</dl>';
$output .= '</div>';
$output .= '</div>';
$output .= '<p>'.HTML::anchor($url_main, 'Back to main list of pets').'</p>';

echo $output;
