<?php
/**
 * Created by PhpStorm.
 * User: seedteam
 * Date: 25.08.20
 * Time: 13:37
 */
$bordConf=[
    'stages' => [
        0 =>[
            'name'=>'Prospecting',
            'display' => true,
            'show' => true,
        ],
        1 =>[
            'name'=>'Qualification',
            'display' => true,
            'show' => true,
        ],
        2 =>[
            'name'=>'Needs Analysis',
            'display' => true,
            'show' => true,
        ],
        3 =>[
            'name'=>'Value Proposition',
            'display' => true,
            'show' => true,
        ],
        4 =>[
            'name'=>'Id. Decision Makers',
            'display' => true,
            'show' => true,
        ],
        5 =>[
            'name'=>'Perception Analysis',
            'display' => true,
            'show' => true,
        ],
        6 =>[
            'name'=>'Proposal/Price Quote',
            'display' => true,
            'show' => true,
        ],
        7 =>[
            'name'=>'Negotiation/Review',
            'display' => true,
            'show' => true,
        ],
        8 =>[
            'name'=>'Closed Won',
            'display' => true,
            'show' => true,
        ],
        9 =>[
            'name'=>'Closed Lost',
            'display' => true,
            'show' => true,
        ],
    ],
    'mainFields' => [
      'name',
      'date_entered',
    ],
    'kanban' => [
        'myKanbanHeight' => 'auto',
        'myKanbanOverflowY' => 'auto',
        'myKanbanOverflowX' => 'scroll',
        'kanbandragHeight' => '450',

    ],
    'limitIterationITems' => 30,
];
/*
 *
 *
 *
 {
  "Prospecting": "Prospecting",
  "Qualification": "Qualification",
  "Needs Analysis": "Needs Analysis",
  "Value Proposition": "Value Proposition",
  "Id. Decision Makers": "Identifying Decision Makers",
  "Perception Analysis": "Perception Analysis",
  "Proposal\/Price Quote": "Proposal\/Price Quote",
  "Negotiation\/Review": "Negotiation\/Review",
  "Closed Won": "Closed Won",
  "Closed Lost": "Closed Lost"
}
 *
 */