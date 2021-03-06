<?php

namespace SqlChartsDashboard\ChartType;

use SqlChartsDashboard\Chart;

use SqlChartsDashboard\SqlChartsDashboardInterface\ChartTypeInterface;

class ChartLine extends Chart implements ChartTypeInterface {
  public function generate () {
    return $this->engine->chart_line ($this, $this->query->run());
  }
}
