<?php
class Pagination
{

	private $totalItems;					// Tổng số phần tử
	private $totalItemsPerPage		= 1;	// Tổng số phần tử xuất hiện trên một trang
	private $pageRange				= 5;	// Số trang xuất hiện
	private $totalPage;						// Tổng số trang
	private $currentPage			= 1;	// Trang hiện tại

	public function __construct($totalItems, $pagination)
	{
		$this->totalItems			= $totalItems;
		$this->totalItemsPerPage	= $pagination['totalItemsPerPage'];

		if ($pagination['pageRange'] % 2 == 0) $pagination['pageRange'] = $pagination['pageRange'] + 1;

		$this->pageRange			= $pagination['pageRange'];
		$this->currentPage			= $pagination['currentPage'];
		$this->totalPage			= ceil($totalItems / $pagination['totalItemsPerPage']);
	}

	public function showPagination()
	{
		// Pagination
		$paginationHTML = '';
		if ($this->totalPage > 1) {
			$start 	= '<li>Start</li>';
			$prev 	= '<li>Previous</li>';
			if ($this->currentPage > 1) {
				$start 	= '<li><a href="?page=1">Start</a></li>';
				$prev 	= '<li><a href="?page=' . ($this->currentPage - 1) . '">Previous</a></li>';
			}

			$next 	= '<li>Next</li>';
			$end 	= '<li>End</li>';
			if ($this->currentPage < $this->totalPage) {
				$next 	= '<li><a href="?page=' . ($this->currentPage + 1) . '">Next</a></li>';
				$end 	= '<li><a href="?page=' . $this->totalPage . '">End</a></li>';
			}

			if ($this->pageRange < $this->totalPage) {
				if ($this->currentPage == 1) {
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				} else if ($this->currentPage == $this->totalPage) {
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				} else {
					$startPage		= $this->currentPage - ($this->pageRange - 1) / 2;
					$endPage		= $this->currentPage + ($this->pageRange - 1) / 2;

					if ($startPage < 1) {
						$endPage	= $endPage + 1;
						$startPage = 1;
					}

					if ($endPage > $this->totalPage) {
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			} else {
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = '';
			for ($i = $startPage; $i <= $endPage; $i++) {
				if ($i == $this->currentPage) {
					$listPages .= '<li class="active">' . $i . '</a>';
				} else {
					$listPages .= '<li><a href="?page=' . $i . '">' . $i . '</a>';
				}
			}

			$paginationHTML = '<ul class="pagination">' . $start . $prev . $listPages . $next . $end . '</ul>';
		}
		return $paginationHTML;
	}

	
	public function showPaginationFrontend()
	{
		
		// Pagination
		$queries = [];
		parse_str(@$_SERVER['QUERY_STRING'], $queries);
		unset($queries['page']);
		$link = 'index.php?' . http_build_query($queries);
		$paginationHTML = '';
		if ($this->totalPage > 1) {
			$paginationHTML = '<div class="product-pagination">
		<div class="theme-paggination-block">
			<div class="container-fluid p-0">
				<div class="row">
					<div class="col-xl-6 col-md-6 col-sm-12">
						<nav aria-label="Page navigation">
							<nav>';
			$start 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fa fa-angle-double-left"></i></a></li>';
			$prev 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fa fa-angle-left"></i></a></li>';
			
			
			if ($this->currentPage > 1) {
				$start 	= sprintf('<li class="page-item"><a href="%s" class="page-link"><i class="fa fa-angle-double-left"></i></a></li>', "$link&page=1");
				$prev 	= sprintf('<li class="page-item"><a href="%s" class="page-link"><i class="fa fa-angle-left"></i></a></li>', "$link&page=" . ($this->currentPage - 1));
			}		


			$next 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fa fa-angle-right"></i></a></li>';
			$end 	= '<li class="page-item disabled"><a href="" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>';
			if ($this->currentPage < $this->totalPage) {
				$next 	= sprintf('<li class="page-item"><a href="%s" class="page-link"><i class="fa fa-angle-right"></i></a></li>', "$link&page=" . ($this->currentPage + 1));
				$end 	= sprintf('<li class="page-item"><a href="%s" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>', "$link&page=" . ($this->totalPage));
			}

			if ($this->pageRange < $this->totalPage) {
				if ($this->currentPage == 1) {
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				} else if ($this->currentPage == $this->totalPage) {
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				} else {
					$startPage		= $this->currentPage - ($this->pageRange - 1) / 2;
					$endPage		= $this->currentPage + ($this->pageRange - 1) / 2;

					if ($startPage < 1) {
						$endPage	= $endPage + 1;
						$startPage = 1;
					}

					if ($endPage > $this->totalPage) {
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			} else {
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = '';
			for ($i = $startPage; $i <= $endPage; $i++) {
				if ($i == $this->currentPage) {
					$listPages .= sprintf('<li class="page-item active"><a class="page-link">%s</a></li>', $i);
				} else {
					$listPages .= sprintf('<li class="page-item"><a class="page-link" href="%s">%s</a></li>', "$link&page=" . $i, $i);
				}
			}

			$paginationHTML .= '<ul class="pagination">' . $start . $prev . $listPages . $next . $end . '</ul>' . '</nav>
			</nav>
		</div>
		<div class="col-xl-6 col-md-6 col-sm-12">
			<div class="product-search-count-bottom">
				<h5>Showing Items 1-'.($this->totalItemsPerPage).' of '.$this->totalItems.' Result</h5>
			</div>
		</div>
	</div>
</div>
</div>
</div>';
			
		}
		return $paginationHTML;
	}

	public function showPaginationBackend()
	{
		// Pagination
		$queries = [];
		parse_str(@$_SERVER['QUERY_STRING'], $queries);
		unset($queries['page']);
		$link = 'index.php?' . http_build_query($queries);
		$paginationHTML = '';
		if ($this->totalPage > 1) {

			$start 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-double-left"></i></a></li>';
			$prev 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>';
			if ($this->currentPage > 1) {
				$start 	= sprintf('<li class="page-item"><a class="page-link" href="%s"><i class="fas fa-angle-double-left"></i></a></li>', "$link&page=1");
				$prev	= sprintf('<li class="page-item"><a class="page-link" href="%s"><i class="fas fa-angle-left"></i></a></li>', "$link&page=" . ($this->currentPage - 1));
			}

			$next 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>';
			$end 	= '<li class="page-item disabled"><a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a></li>';
			if ($this->currentPage < $this->totalPage) {
				$next 	= sprintf('<li class="page-item"><a class="page-link" href="%s"><i class="fas fa-angle-right"></i></a></li>', "$link&page=" . ($this->currentPage + 1));
				$end 	= sprintf('<li class="page-item"><a class="page-link" href="%s"><i class="fas fa-angle-double-right"></i></a></li>', "$link&page=" . $this->totalPage);
			}

			if ($this->pageRange < $this->totalPage) {
				if ($this->currentPage == 1) {
					$startPage 	= 1;
					$endPage 	= $this->pageRange;
				} else if ($this->currentPage == $this->totalPage) {
					$startPage		= $this->totalPage - $this->pageRange + 1;
					$endPage		= $this->totalPage;
				} else {
					$startPage		= $this->currentPage - ($this->pageRange - 1) / 2;
					$endPage		= $this->currentPage + ($this->pageRange - 1) / 2;

					if ($startPage < 1) {
						$endPage	= $endPage + 1;
						$startPage = 1;
					}

					if ($endPage > $this->totalPage) {
						$endPage	= $this->totalPage;
						$startPage 	= $endPage - $this->pageRange + 1;
					}
				}
			} else {
				$startPage		= 1;
				$endPage		= $this->totalPage;
			}

			$listPages = '';
			for ($i = $startPage; $i <= $endPage; $i++) {
				if ($i == $this->currentPage) {
					$listPages .= sprintf('<li class="page-item active"><a class="page-link" href="#">%s</a></li>', $i);
				} else {
					$listPages .= sprintf('<li class="page-item"><a class="page-link" href="%s">%s</a></li>', "$link&page=" . $i, $i);
				}
			}
			$paginationHTML = '<ul class="pagination m-0 float-right">' . $start . $prev . $listPages . $next . $end . '</ul>';
		}
		return $paginationHTML;
	}
}
