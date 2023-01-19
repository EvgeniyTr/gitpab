<?php

namespace App\Model\Service\Eloquent;

use App\Model\Repository\IssueRepositoryEloquent;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property IssueRepositoryEloquent $repository
 */
class EloquentIssueService extends CrudServiceAbstract
{
    use StoreContributorsTrait;
    use StoreLabelsTrait;

    public function __construct()
    {
        $this->repository = app(AppServiceProvider::ISSUE_REPOSITORY);
    }

    /**
     * @inheritdoc
     */
    public function storeList(Collection $list)
    {
        $this->storeContributors($list, ['author', 'assignee']);
        $this->storeLabels($list, 'labels');
        parent::storeList($list);
    }

    public function getLastUpdateAt(int $projectId)
    {
        $issue = $this->repository->getLastUpdatedIssue($projectId);
        if (!$issue) {
            return null;
        }
        return $issue->gitlab_updated_at;
    }

    public function getTotalEstimate(array $parameters)
    {
        $query = $this->repository->getListQuery($parameters);
        $query->select(DB::raw('sum(estimate) as total'));
        return $query->first()->total;
    }

    public function getTotalTime(array $parameters)
    {
        return $this->repository->getTotalSpentTime($parameters);
    }
}
