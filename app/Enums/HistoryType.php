<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Waiting()
 * @method static static Process()
 * @method static static Disposition()
 * @method static static Coordination()
 * @method static static Done()
 */
final class HistoryType extends Enum
{
    const Waiting = 0;
    const Process = 1;
    const Disposition = 2;
    const Coordination = 3;
    const Done = 4;
}
