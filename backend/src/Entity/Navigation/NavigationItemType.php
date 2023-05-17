<?php

namespace App\Entity\Navigation;

enum NavigationItemType: string
{
    case InternalLink =  'InternalLink';
    case Group = 'Group';

}
