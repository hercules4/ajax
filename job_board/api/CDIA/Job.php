<?php

namespace CDIA;

use Symfony\Component\HttpFoundation\Request;
use \Silex\Application;

class Job {
    
    private $app;
    
    /**
     * @param Application $app 
     */
    public function __construct(Application $app) {
        $this->app = $app;
    }
    
    /**
     * Get all jobs or jobs by search params.
     * e.g. jobs?search[category]=design, jobs?search[keyword]=css 
     *
     * @param Request $request 
     * @return array|false
     */
    public function getAll(Request $request) {
        $query = <<<EOD
    
        SELECT job.id AS id, job.title, job.company, location.name AS location_name, type.name AS type, category.name AS category_name, keywords.keyword_list
        FROM job 
        INNER JOIN location ON location.id = job.location_id 
        INNER JOIN type ON type.id = job.type_id  
        INNER JOIN category ON category.id = job.category_id 
        LEFT OUTER JOIN (
            SELECT job_keyword.job_id as job_id, group_concat(keyword.name separator ', ') as keyword_list
            FROM job_keyword
            INNER JOIN keyword ON keyword.id = job_keyword.keyword_id
            GROUP BY job_keyword.job_id
        ) AS keywords 
            ON keywords.job_id = job.id
                  
EOD;

        // build up the WHERE clause based on the search params
        $search = $request->get('search');

        $params = array();

        if (!is_null($search)) {
            $where = '';
    
            if (isset($search['keyword']) && $search['keyword'] !== '') {
                if ($where === '') {
                    $where .= " WHERE FIND_IN_SET(:keyword_with_no_spaces, REPLACE(keywords.keyword_list, SPACE(1), ''))";
                } else {
                    $where .= " AND FIND_IN_SET(:keyword_with_no_spaces, REPLACE(keywords.keyword_list, SPACE(1), ''))";
                }
        
                $params['keyword_with_no_spaces'] = str_replace(' ', '', $search['keyword']);
            }
    
            if (isset($search['location']) && $search['location'] !== '') {
                if ($where === '') {
                    $where .= " WHERE location.name = :location";
                } else {
                    $where .= " AND location.name = :location";
                }
        
                $params['location'] = $search['location'];
            }
    
            if (isset($search['category']) && $search['category'] !== '') {
                if ($where === '') {
                    $where .= " WHERE category.name = :category";
                } else {
                    $where .= " AND category.name = :category";
                }
        
                $params['category'] = $search['category'];
            }
    
            $query .= $where;
        }
        
        $stmt = $this->app['db']->prepare($query);
        
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }
    
    /**
     * Get a job by id.
     *
     * @param int $id 
     * @return object|false
     */
    public function getById(int $id) {
        $query = "SELECT * FROM job WHERE job.id = :id";
        
        $stmt = $this->app['db']->prepare($query);
        
        $stmt->execute(array($id));
        
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }
    
}

?>