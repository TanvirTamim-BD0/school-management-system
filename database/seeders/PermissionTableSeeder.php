<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            [
              'group_name' => 'dashboard',
              'permissions' => [
                'student-count-view',
                'teacher-count-view',
                'guardian-count-view',
                'class-count-view',
                'latest-student-list',
                'dashboard-student-book-issue-list',
                'upcoming-notice',
                'dashboard-leave-application-list',
              ],

              'permission_short' => [
                'student-count-view',
                'teacher-count-view',
                'guardian-count-view',
                'class-count-view',
                'latest-student-list',
                'student-book-issue-list',
                'upcoming-notice',
                'dashboard-leave-application-list',
              ]

            ],

            [
              'group_name' => 'user',
              'permissions' => [
                'user-list',
                'user-create',
                'user-edit',
                'user-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]

            ],
            [
              'group_name' => 'role',
              'permissions' => [
                'role-list',
                 'role-create',
                 'role-edit',
                 'role-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'class',
              'permissions' => [
                'class-list',
                'class-create',
                'class-edit',
                'class-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'section',
              'permissions' => [
                'section-list',
                'section-create',
                'section-edit',
                'section-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'group',
              'permissions' => [
                'group-list',
                'group-create',
                'group-edit',
                'group-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'session',
              'permissions' => [
                'session-list',
                'session-create',
                'session-edit',
                'session-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'subject',
              'permissions' => [
                'subject-list',
                'subject-create',
                'subject-edit',
                'subject-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'room',
              'permissions' => [
                'room-list',
                'room-create',
                'room-edit',
                'room-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'assignment',
              'permissions' => [
                'assignment-list',
                'assignment-create',
                'assignment-edit',
                'assignment-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'syllabus',
              'permissions' => [
                'syllabus-list',
                'syllabus-create',
                'syllabus-edit',
                'syllabus-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'class-routine',
              'permissions' => [
                'class-routine-list',
                'class-routine-create',
                'class-routine-edit',
                'class-routine-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'student',
              'permissions' => [
                'student-list',
                'student-create',
                'student-edit',
                'student-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'teacher',
              'permissions' => [
                'teacher-list',
                'teacher-create',
                'teacher-edit',
                'teacher-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'teacher-assign',
              'permissions' => [
                'teacher-assign-list',
                'teacher-assign-create',
                'teacher-assign-edit',
                'teacher-assign-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'librarian',
              'permissions' => [
                'librarian-list',
                'librarian-create',
                'librarian-edit',
                'librarian-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
           
            [
              'group_name' => 'accountent',
              'permissions' => [
                'accountent-list',
                'accountent-create',
                'accountent-edit',
                'accountent-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'guardian',
              'permissions' => [
                'guardian-list',
                'guardian-create',
                'guardian-edit',
                'guardian-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'attendace-of-student',
              'permissions' => [
                'attendace-of-student-list',
                'attendace-of-student-create',
                'attendace-of-student-edit',
                'attendace-of-student-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'attendace-of-teacher',
              'permissions' => [
                'attendace-of-teacher-list',
                'attendace-of-teacher-create',
                'attendace-of-teacher-edit',
                'attendace-of-teacher-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
           
            [
              'group_name' => 'attendace-of-accountent',
              'permissions' => [
                'attendace-of-accountent-list',
                'attendace-of-accountent-create',
                'attendace-of-accountent-edit',
                'attendace-of-accountent-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            
            [
              'group_name' => 'attendace-of-librarian',
              'permissions' => [
                'attendace-of-librarian-list',
                'attendace-of-librarian-create',
                'attendace-of-librarian-edit',
                'attendace-of-librarian-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'admission',
              'permissions' => [
                'admission-list',
                'admission-create',
                'admission-edit',
                'admission-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],


            [
              'group_name' => 'admission-form',
              'permissions' => [
                'admission-form-list',
                'admission-form-delete',
              ],

              'permission_short' => [
                'list',
                'delete',
              ]
            ],


            [
              'group_name' => 'expense',
              'permissions' => [
                'expense-list',
                'expense-create',
                'expense-edit',
                'expense-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'income',
              'permissions' => [
                'income-list',
                'income-create',
                'income-edit',
                'income-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            
            [
              'group_name' => 'leave-category',
              'permissions' => [
                'leave-category-list',
                'leave-category-create',
                'leave-category-edit',
                'leave-category-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'leave-assign',
              'permissions' => [
                'leave-assign-list',
                'leave-assign-create',
                'leave-assign-edit',
                'leave-assign-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'leave-apply',
              'permissions' => [
                'leave-apply-list',
                'leave-apply-create',
                'leave-apply-edit',
                'leave-apply-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],


            [
              'group_name' => 'leave-apply-admin',
              'permissions' => [
                'leave-apply-admin-list',
              ],

              'permission_short' => [
                'list',
              ]
            ],

            [
              'group_name' => 'fees-type',
              'permissions' => [
                'fees-type-list',
                'fees-type-create',
                'fees-type-edit',
                'fees-type-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'fees-assign',
              'permissions' => [
                'fees-assign-list',
                'fees-assign-create',
                'fees-assign-edit',
                'fees-assign-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'fees-assign-student',
              'permissions' => [
                'fees-assign-student-list',
                'fees-assign-student-create',
                'fees-assign-student-edit',
                'fees-assign-student-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'payment-of-student',
              'permissions' => [
                'payment-of-student-list',
                'payment-of-student-create',
                'payment-of-student-edit',
                'payment-of-student-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
            [
              'group_name' => 'mail/sms',
              'permissions' => [
                'mail-list',
                'sms-list',
              ],

              'permission_short' => [
                'mail-list',
                'sms-list',
              ]
            ],

            [
              'group_name' => 'exam',
              'permissions' => [
                'exam-list',
                'exam-create',
                'exam-edit',
                'exam-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],


            [
              'group_name' => 'library-rack',
              'permissions' => [
                'library-rack-list',
                'library-rack-create',
                'library-rack-edit',
                'library-rack-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'author',
              'permissions' => [
                'author-list',
                'author-create',
                'author-edit',
                'author-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
           
            [
              'group_name' => 'book-category-of-library',
              'permissions' => [
                'book-category-of-library-list',
                'book-category-of-library-create',
                'book-category-of-library-edit',
                'book-category-of-library-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'library-book',
              'permissions' => [
                'library-book-list',
                'library-book-create',
                'library-book-edit',
                'library-book-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],

            [
              'group_name' => 'library-student-book-issue',
              'permissions' => [
                'student-book-issue-list',
                'student-book-issue-create',
                'student-book-issue-edit',
                'student-book-issue-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],
           
            [
              'group_name' => 'library-teacher-book-issue',
              'permissions' => [
                'teacher-book-issue-list',
                'teacher-book-issue-create',
                'teacher-book-issue-edit',
                'teacher-book-issue-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],


            [
              'group_name' => 'notice',
              'permissions' => [
                'notice-list',
                'notice-create',
                'notice-edit',
                'notice-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],


            [
              'group_name' => 'event',
              'permissions' => [
                'event-list',
                'event-create',
                'event-edit',
                'event-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],


            [
              'group_name' => 'holiday',
              'permissions' => [
                'holiday-list',
                'holiday-create',
                'holiday-edit',
                'holiday-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],


             [
              'group_name' => 'blog',
              'permissions' => [
                'blog-list',
                'blog-create',
                'blog-edit',
                'blog-delete',
              ],

              'permission_short' => [
                'list',
                'create',
                'edit',
                'delete',
              ]
            ],


            [
              'group_name' => 'contact-form',
              'permissions' => [
                'contact-form-list',
                'contact-form-delete',
              ],

              'permission_short' => [
                'list',
                'delete',
              ]
            ],


            [
              'group_name' => 'report',
              'permissions' => [
                'class-report',
                'student-report',
                'class-routine-report',
                'student-attendence-report',
                'teacher-attendence-report',
                'addmission-report',
                'library-book-report',
                'library-book-issue-report',
              ],

              'permission_short' => [
                'class',
                'student',
                'class-routine',
                'student-attendence',
                'teacher-attendence',
                'addmission',
                'library-book',
                'library-book-issue',
              ]
            ],
            
            [
              'group_name' => 'administrative',
              'permissions' => [
                'extend-class-of-students',
                'default-session',
              ],

              'permission_short' => [
                'extend-class-of-students',
                'default-session',
              ]
            ],

            [
              'group_name' => 'settings',
              'permissions' => [
                'contact',
                'push-notification',
                'rollback',
              ],

              'permission_short' => [
                'contact',
                'push-notification',
                'rollback',
              ]
            ],
           
            [
              'group_name' => 'payroll-access',
              'permissions' => [
                'make-payment',
              ],

              'permission_short' => [
                'make-payment',
              ]
            ],

        ];
   
        // Create Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'short_name' => $permissions[$i]['permission_short'][$j], 'group_name' => $permissionGroup]);
            }
        }
    }
}
