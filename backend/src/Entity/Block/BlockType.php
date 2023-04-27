<?php

namespace App\Entity\Block;

enum BlockType: string
{
    case HorizontalRule =  'horizontalRule';
    case Header = 'header';
    case Text = 'text';
}
