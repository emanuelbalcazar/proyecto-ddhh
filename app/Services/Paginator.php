<?php

namespace App\Services;

class Paginator {

  private $page;
  private $pageSize;
  private $total;
  private $data;

  public function __construct($page, $pageSize, $total, $data) {
      $this->page = $page;
      $this->pageSize = $pageSize;
      $this->total = $total;
      $this->data = $data;
  }

  public function page() {
    return $this->page;
  }

  public function pageSize() {
    return $this->pageSize;
  }

  public function total() {
    return $this->total;
  }

  public function data() {
    return $this->data;
  }

  public function __toString() {
      return $this->toJson();
  }

  public function toArray() {
      return [
          'page_size' => $this->pageSize(),
          'page' => $this->page(),
          'total' => $this->total(),
          'data' => $this->data->toArray()
      ];
  }

  public function jsonSerialize() {
      return $this->toArray();
  }

  public function toJson($options = 0) {
      return json_encode($this->jsonSerialize(), $options);
  }

}
