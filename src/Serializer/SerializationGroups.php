<?php

namespace App\Serializer;

enum SerializationGroups
{
    case BASE_READ;
    case BASE_WRITE;
    case CATEGORY_READ;
    case CATEGORY_WRITE;
}
