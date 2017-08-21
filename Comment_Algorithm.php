class commentRanking{
    /**
     *  confidence sort based on http://www.evanmiller.org/how-not-to-sort-by-average-rating.html
     * 
     * @since   0.1
     * @access  private
     * @param   int $upvotes, int $downvotes
     * @return  double
     * @see     http://www.evanmiller.org/how-not-to-sort-by-average-rating.html
     */

    private function _confidence($upvotes = 0, $downvotes = 0) {
        $n = $upvotes + $downvotes;
        
        if($n === 0) {
            return 0;
        }
        
        $z = 1.281551565545; // 80% confidence
        $p = floor($upvotes) / $n;
        
        $left = $p + 1/(2*$n)*$z*$z;
        $right = $z*sqrt($p*(1-$p)/$n + $z*$z/(4*$n*$n));
        $under = 1+1/$n*$z*$z;
        
        return ($left - $right) / $under;
    }

    /**
     * public method to calculate a posts confidence
     * 
     * @since   0.1
     * @param   int $upvotes, int $downvotes
     * @access  public
     * @return  double
     */
    public function confidence($upvotes, $downvotes) {
        return $this->_confidence($upvotes, $downvotes);
    }
}
