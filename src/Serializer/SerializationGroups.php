<?php

namespace App\Serializer;

enum SerializationGroups
{
    const READ = 'read';

    const CATEGORY_READ = 'category:read';
    const CATEGORY_WRITE = 'category:write';
}
