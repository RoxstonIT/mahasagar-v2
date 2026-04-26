<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            
            // Category Management Permissions :
            ['name' => 'add_news_categories', 'label' => 'Add News Categories'],
            ['name' => 'view_categories', 'label' => 'View Categories'],
            ['name' => 'create_category', 'label' => 'Create Category'],
            ['name' => 'edit_category', 'label' => 'Edit Category'],
            ['name' => 'delete_category', 'label' => 'Delete Category'],

            // News Article Management Permissions :
            ['name' => 'submit_news_article', 'label' => 'Submit News Article'],
            ['name' => 'edit_news_article_before_approval', 'label' => 'Edit News Article Before Approval'],
            ['name' => 'delete_news_article_before_approval', 'label' => 'Delete News Article Before Approval'],
            ['name' => 'approve_disapprove_news_article', 'label' => 'Approve / Disapprove News Article'],
            ['name' => 'edit_news_article_after_approval', 'label' => 'Edit News Article After Approval'],
            ['name' => 'delete_approved_news_article', 'label' => 'Delete Approved News Article'],

            // Homepage News Management Permissions :
            ['name' => 'manage_homepage_news', 'label' => 'Manage Homepage News'],

            // Article Comment Moderation Permissions :
            ['name' => 'moderate_article_comments', 'label' => 'Moderate Article Comments'],
        ];

        $permissionIds = [];

        foreach ($permissions as $perm) {
            $permission = Permission::firstOrCreate(
                ['name' => $perm['name']],
                ['label' => $perm['label']]
            );

            $permissionIds[] = $permission->id;
        }

        $role = Role::firstOrCreate(
            ['name' => 'superadmin'],
            ['label' => 'Super Admin']
        );

        $role->permissions()->sync($permissionIds);

        Role::firstOrCreate(
            ['name' => 'reader'],
            ['label' => 'Reader']
        );
    }
}
