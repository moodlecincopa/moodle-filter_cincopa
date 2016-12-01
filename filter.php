<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version information
 *
 * @package    filter
 * @subpackage cincopa
 * @copyright  Cincopa LTD <moodle@cincopa.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
class filter_cincopa extends moodle_text_filter
{
	public function filter($text, array $options = array())
	{
		//Get all matches without bracket from text
		$matches=array();
		preg_match_all("/\\[(.*?)\\]/", $text, $matches);

		if(!empty($matches))
		{
			//Matches without breacket
			$finded_matches = $matches[1];
			$cincopa_string = '';
			$gallery_string = '';
			//Iterate loop on finded_matches
			foreach ($finded_matches as $matches_key => $matches_val)
			{
				//Break matches_val into array
				$matches_val   = str_replace('&nbsp;', ' ', $matches_val);
				$breaked_array = explode(' ', $matches_val);
                
                if(!empty($breaked_array[0]) && !empty($breaked_array[1])) {

				$cincopa_string = $breaked_array[0];
				$gallery_string = $breaked_array[1];
                }
				//Now find a particular string in whole text and
				//replace it with a predefined string

				//Generate random string
				$characters       = time().'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomString     = '';
				for ($i = 0; $i < 6; $i++)
					$randomString .= $characters[rand(0, 10 - 1)];

				$predefined_string = '';
				$predefined_string .= '<div id="cp_widget_'.$randomString.'">&nbsp;</div>';
				$predefined_string .='
				<script type="text/javascript">
				var cpo = []; cpo["_object"] ="cp_widget_'.$randomString.'"; cpo["_fid"] = "'.$gallery_string.'";
				var _cpmp = _cpmp || []; _cpmp.push(cpo);
				(function() { var cp = document.createElement("script"); cp.type = "text/javascript";
				cp.async = true; cp.src = "//www.cincopa.com/media-platform/runtime/libasync.js";
				var c = document.getElementsByTagName("script")[0];
				c.parentNode.insertBefore(cp, c); })(); </script>';

				//Now find cincopa string in whole text
				$cincopa_string_for_find          = "[$cincopa_string&nbsp;$gallery_string]";
				$cincopa_string_for_find_wo_space = "[$cincopa_string $gallery_string]";
				$text                             = str_replace($cincopa_string_for_find, $predefined_string, $text);
				$text                             = str_replace($cincopa_string_for_find_wo_space, $predefined_string, $text);
			}
		}
		return $text;
	}
}
