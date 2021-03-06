<?php

namespace SqlChartsDashboard;

abstract class Chart {

  public $name = '';

  public $query = null;

  public $engine = null;

  public $columns = null;

  public $options = null;

  public $filters = null;

  public function __construct ($name, $query = null, $columns = null, $options = null, $engine = null) {
      $this->name = $name;
      $this->setQuery($query);
      $this->columns = $columns;
      $this->options = $options;
      if (!$engine) $engine = Dashboard::getDefaultChartsEngine();
      $this->setChartsEngine($engine);
  }

  public function setChartsEngine ($engine) {
    if (is_string($engine)) {
      $class_engine =  '\\SqlChartsDashboard\ChartsEngine\\'.$engine;
      if (class_exists ($class_engine)) {
        $this->engine = new $class_engine ();
      }else {
        //TODO: Exception
        echo "Error no chart engine";
      }
    }else if (is_object ($engine)) {
      $this->engine = $engine;
    }
  }

  public function getChartsEngine () {
    return $this->engine;
  }

  public function getName () {
    return $this->name;
  }

  public function setColumns ($columns) {
    $this->columns = $columns;
    return $this;
  }

  public function getColumns (){
    return $this->columns;
  }

  public function setOptions ($options) {
    $this->options = $options;
    return $this;
  }

  public function getOptions () {
    return $this->options;
  }

  public function setFilters ($filters) {
    $this->filters = $filters;
    if (is_object($this->query)) {
      $this->query->setFilters ($this->filters);
    }
  }

  public function setQuery ($query, $connection = null) {
    if (is_string ($query)) {
      $this->query = new Query ($query, $connection);
    }else {
      $this->query = $query;
    }
    $this->query->setFilters ($this->filters);
    return $this;
  }

  abstract public function generate ();

}
