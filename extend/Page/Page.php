<?php
/**
 * 自定义分页
 */
namespace Page;

class Page
{
    public $pageSize = 10;             // 每页条数
    private $total_number = 0;          // 总条数
    private $pageIndex = 1;             // 当前页数
    public $page_total_number = 0;     // 总页数
    public $firstRow = 0;              // 起始条数

    public function __construct($pageIndex = 1, $pageSize = 10, $total_number = 0)
    {
        $this->pageIndex = $pageIndex <= 0 ? 1 : $pageIndex;
        $this->pageSize = $pageSize <= 0 ? 10 : $pageSize;
        $this->total_number = $total_number <= 0 ? 0 : $total_number;
        $this->page_total_number = ceil($this->total_number / $this->pageSize);
        $this->firstRow = ($this->pageIndex - 1) * $pageSize;
    }

    public function show()
    {
        return [
            'page_current' => (int)$this->pageIndex,
            'page_total_number' => (int)$this->page_total_number,
            'page_size' => (int)$this->pageSize,
            'total_number' => (int)$this->total_number
        ];
    }

}
