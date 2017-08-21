<?php
class hotRanking{
    /**
     * calculates the score for a link (upvotes - downvotes)
     * 
     * @access  private
     * @since   0.1
     * @param   int $upvotes, int $downvotes
     * @return  int
     */
    private function _score($upvotes = 0, $downvotes = 0) {
        return $upvotes - $downvotes;
    }
    
    /**
     * calculates the hotness of an article
     * 
     * @access  private
     * @since   0.1
     * @param   int $upvotes, int $downvotes, int $posted
     * @return  float
     */
    private function _hotness($upvotes = 0, $downvotes = 0, $posted = 0) {
        $s = $this->_score($upvotes, $downvotes);
        $order = log(max(abs($s), 1), 10);
        
        if($s > 0) {
            $sign = 1;
        } elseif($s < 0) {
            $sign = -1;
        } else {
            $sign = 0;
        }
        
        $seconds = $posted - 1134028003;
        
        return round($order + (($sign * $seconds)/45000), 7);
    }
}
?>