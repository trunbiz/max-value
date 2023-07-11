<?php

namespace App\Components;

use App\Models\Tax;

class TaxRecusive
{
    private $data;
    private $htmlSelect = '';

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function taxRecusive($parent_id, $id = 0, $text = '')
    {
        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                if(!empty($parent_id) && $parent_id == $value['id']){
                    $this->htmlSelect .= "<option selected value='" . $value['id'] . "'>" . $text . $value['taxOut'] . "</option>";
                }else{
                    $this->htmlSelect .= "<option value='" . $value['id'] . "'>" . $text . $value['taxOut'] . "</option>";
                }
                $this->taxRecusive($parent_id, $value['id'], $text . '--');
            }
        }
        return $this->htmlSelect;
    }
}

