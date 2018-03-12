<?php
/**
 * User: fabian
 * Date: 09.03.18
 * Time: 01:38
 */

namespace Lara\utilities;


use Lara\Role;
use Lara\Section;
use Lara\User;
use Log;

class RoleUtility
{
    const PRIVILEGE_ADMINISTRATOR = "admin";

    const PRIVILEGE_CL = "clubleitung";

    const PRIVILEGE_MARKETING = "marketing";

    const PRIVILEGE_MEMBER = "member";

    const ALL_PRIVILEGES = [self::PRIVILEGE_ADMINISTRATOR, self::PRIVILEGE_CL, self::PRIVILEGE_MARKETING, self::PRIVILEGE_MEMBER];

    public static function assignPrivileges(User $user, Section $section, $privilege)
    {
        switch ($privilege) {
            case self::PRIVILEGE_ADMINISTRATOR:
                Role::where('section_id', '=', $section->id)->where('name', '=', self::PRIVILEGE_ADMINISTRATOR)->first()->users()->attach($user);
            case self::PRIVILEGE_CL:
                Role::where('section_id', '=', $section->id)->where('name', '=', self::PRIVILEGE_CL)->first()->users()->attach($user);
            case self::PRIVILEGE_MARKETING:
                Role::where('section_id', '=', $section->id)->where('name', '=', self::PRIVILEGE_MARKETING)->first()->users()->attach($user);
            case self::PRIVILEGE_MEMBER:
                Role::where('section_id', '=', $section->id)->where('name', '=', self::PRIVILEGE_MEMBER)->first()->users()->attach($user);
                break;
            default:
                Log::warning('could not assign privilege ' . $privilege, [$user, $section]);
        }
    }

    public static function removePrivileges(User $user, Section $section, $privilege)
    {
        switch ($privilege) {
            case self::PRIVILEGE_ADMINISTRATOR:
                Role::where('section_id', '=', $section->id)->where('name', '=', self::PRIVILEGE_ADMINISTRATOR)->first()->users()->detach($user);
            case self::PRIVILEGE_CL:
                Role::where('section_id', '=', $section->id)->where('name', '=', self::PRIVILEGE_CL)->first()->users()->detach($user);
            case self::PRIVILEGE_MARKETING:
                Role::where('section_id', '=', $section->id)->where('name', '=', self::PRIVILEGE_MARKETING)->first()->users()->detach($user);
            case self::PRIVILEGE_MEMBER:
                Role::where('section_id', '=', $section->id)->where('name', '=', self::PRIVILEGE_MEMBER)->first()->users()->detach($user);
                break;
            default:
                Log::warning('could not unassign privilege ' . $privilege, [$user, $section]);
        }
    }
}
