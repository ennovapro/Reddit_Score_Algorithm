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
    private function _score($upvotes, $downvotes) {
        return $upvotes - $downvotes;
    }

    /**
     * calculates the hotness of an article
     * 
     * @access  private
     * @since   0.1
     * @param   int $upvotes, int $downvotes, int $datePosted
     * @return  float
     * Notes: $datePosted should be the unix timestamp in seconds of the date that the post was posted   
     */
    private function _hotness($upvotes, $downvotes, $datePosted) {
        $s = $this->_score($upvotes, $downvotes);
        $order = log(max(abs($s), 1), 10);
        
        if($s > 0) {
            $sign = 1;
        } elseif($s < 0) {
            $sign = -1;
        } else {
            $sign = 0;
        }
        
        $seconds = $datePosted - 1134028003;
        
        return round($order + (($sign * $seconds)/45000), 7);
    }

    /**
     * public method to calculate a post's hotness
     * 
     * @since   0.1
     * @param   int $upvotes, int $downvotes, int $datePosted
     * @access  public
     * @return  float
     */
    public function hotness($upvotes, $downvotes, $datePosted) {
        return $this->_hotness($upvotes, $downvotes, $datePosted);
    }
}
?>