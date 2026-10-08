<?php

function preparePagination(array $data,string $type)
{
  if (!empty($data)) {
    $prepareLi = "";
    $pagesNumber = ceil($data['total'] / 10);
    $prevPage = ($data['currentPage'] > 1) ? $data['currentPage'] - 1 : 1;
    $nextPage = ($data['currentPage'] < $pagesNumber) ? $data['currentPage'] + 1: $pagesNumber;
    $isprevPageDisabled = ($data['currentPage'] > 1) ? '' : 'disabled';
    $isNextPageDisabled = ($data['currentPage'] < $pagesNumber) ? '' : 'disabled';
    

    $profileLink = route('/profile');

    for ($i = 1; $i <= $pagesNumber; $i++) {
      $isActive = ($data['currentPage'] == $i) ? 'active' : '';
      $prepareLi .= "<li class='page-item'><a class='page-link {$isActive}' href='{$profileLink}?{$type}-page={$i}'>{$i}</a></li>";
    }

    echo "
  <nav aria-label='Page navigation example'>
    <ul class='pagination'>
      <li class='page-item'><a class='page-link {$isprevPageDisabled}' href='{$profileLink}?{$type}-page={$prevPage}'>Previous</a></li>
      {$prepareLi}
      <li class='page-item'><a class='page-link {$isNextPageDisabled}' href='{$profileLink}?{$type}-page={$nextPage}'>Next</a></li>
    </ul>
  </nav>
  ";
  }
  echo "";
}
