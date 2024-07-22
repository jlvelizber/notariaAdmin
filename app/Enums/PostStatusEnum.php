<?php
namespace App\Enums;
enum PostStatusEnum : string {

    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case TRASH = 'trash';
    

}