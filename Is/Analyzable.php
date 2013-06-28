<?php

namespace Goutte\QuadsphereGoBundle\Is;

interface Analyzable {
    public function analyze();
    public function needsAnalysis();
    public function setAnalysisNeed($need);
}