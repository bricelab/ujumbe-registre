<?php

namespace App\Utils;

class Enum
{
    public const SEXE_MALE = "content.sexe.male";
    public const SEXE_FEMALE = "content.sexe.female";

    public const REGISTRE_TYPE_INCOMING = "content.registre.type.in";
    public const REGISTRE_TYPE_OUTCOMING = "content.registre.type.out";

    public const REGISTRE_STATUS_OPENED = "content.registre.status.opened";
    public const REGISTRE_STATUS_CLOSED = "content.registre.status.closed";
    public const REGISTRE_STATUS_ARCHIVED = "content.registre.status.archived";
    public const REGISTRE_STATUS_TRASHED = "content.registre.status.trashed";
    public const REGISTRE_STATUS_DELECTED = "content.registre.status.delected";

    public const COURRIER_STATUS_OK = "content.courrier.status.ok";
    public const COURRIER_STATUS_TRASHED = "content.courrier.status.trashed";
    public const COURRIER_STATUS_DELECTED = "content.courrier.status.delected";


}