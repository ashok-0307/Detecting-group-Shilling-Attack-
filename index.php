<?php
include './header.php';
?>
<p style="font-size: 14px;">In this project a new proposal named group shilling attack detection method based on the bisecting K-means clustering algorithm is implemented. First, we extract the rating track of each item and divide the rating tracks to generate candidate groups according to a fixed time interval. Second, we propose item attention degree and user activity to calculate the suspicious degrees of candidate groups.  Finally, we employ the bisecting K-means algorithm to cluster the candidate groups according to their suspicious degrees and obtain the attack groups. The results of experiments on the Netflix and Amazon data sets indicate that the proposed method outperforms the baseline methods.</p>
<?php
include './footer.php';
?>