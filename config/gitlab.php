<?php

$gitlabHost = env('GITLAB_HOST', 'https://gitlab.com/');

return [

    'urls' => [
        'host' => $gitlabHost,
        'project-list' => $gitlabHost . 'api/v4/projects',
        'project-item' => $gitlabHost . 'api/v4/projects/:project_id',
        'project-issue-list' => $gitlabHost . 'api/v4/projects/:project_id/issues',
        'project-issue-item' => $gitlabHost . 'api/v4/projects/:project_id/issues/:issue_iid',
        'project-issue-note-list' => $gitlabHost . 'api/v4/projects/:project_id/issues/:issue_iid/notes',
        'project-milestone-list' => $gitlabHost . 'api/v4/projects/:project_id/milestones',
        'group-milestone-list' => $gitlabHost . 'api/v4/groups/:group_id/milestones',
    ],

    'token' => env('GITLAB_PRIVATE_TOKEN'),

    'default_per_page' => env('GITLAB_DEFAULT_PER_PAGE', 100),

    'restrictions' => [
        // int[]|null
        'project_ids' => env('GITLAB_RESTRICTIONS_PROJECT_IDS')
            ? explode(',', env('GITLAB_RESTRICTIONS_PROJECT_IDS'))
            : [],
        'group_ids' => env('GITLAB_RESTRICTIONS_GROUP_IDS')
            ? explode(',', env('GITLAB_RESTRICTIONS_GROUP_IDS'))
            : [],
    ],

];
