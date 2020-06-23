<?php

class WordList{
	private $ToeicList = [
		array('abided', "遵守"),
		array('absolute', "絕對的"),
		array('alternate', "備用的"),
		array('analyze', "分析"),
		array('compulsory', "必修的"),
		array('damage', "損傷"),
		array('depression', "蕭條"),
		array('distraction', "分心"),
		array('eagerly', "急切的"),
		array('edition', "版"),
		array('equally', "相等"),
		array('evict', "趕出"),
		array('exceed', "超過"),
		array('excessive', "過多"),
		array('firmly', "遵守"),
		array('fluctuaction', "遵守"),
		array('forbidden', "遵守"),
		array('glossy', "遵守"),
		array('implement', "遵守"),
		array('inferior', "遵守"),
		array('inhabitant', "遵守"),
		array('invalidation', "遵守"),
		array('leak', "遵守"),
		array('legitimate', "遵守"),
		array('maintain', "遵守"),
		array('predict', "遵守"),
		array('prerquisite', "遵守"),
		array('preservation', "遵守"),
		array('prohibit', "遵守"),
		array('projection', "遵守"),
		array('propertion', "遵守"),
		array('relevant', "遵守"),
		array('renew', "遵守"),
		array('steep', "遵守"),
		array('subscribe', "遵守"),
		array('violate', "遵守"),
		array('widely', "遵守")
	];

	public function getList(){
		return $this->ToeicList;
	}

	public $prime = [2,3,5,7,11,13,17];

	public function getprime($n, $count){
		//return $n > $this->prime[$index] ? array_push($this->prime[$index], $this->getprime($n, $index+1)) : array();
		$prime_arr = array();
		for($i=0; $this->prime[$i] <= $n; ++$i){
			if($n%$this->prime[$i]==0)array_push($prime_arr, $this->prime[$i]);
		}
		$retn = array();
		for($i=0; $i<$count; ++$i){
			array_push($retn, $prime_arr[rand(0, count($prime_arr)-1)]);
		}
		return $retn;
	}

	public function getTest($words_n, $test_n, $wordcount = null){
		$retn = array();
		//toeic = 2;
		//book_10 = 3;
		//book_11 = 5;
		//book_12 = 7;
		$WordList = $this->ToeicList;
		$wordcount = $wordcount==null ? count($WordList) : $wordcount;
		//topic_zh = 2;
		//topic_en = 3;
		$topic_arr = [2, 3];
		$TestModule = $this->getprime($test_n, $wordcount);
		shuffle($WordList);
		for($i = 0; $i < $wordcount; ++$i){
			array_push($retn, array($TestModule[$i], $WordList[$i]));
		}
		return $retn;
	}
} 