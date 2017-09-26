class Review
{
	private teacherRate;
	private teacherReview;
	private classRate;
	private classReview;
	private sender;
	public function print()
	{
		echo "--REVIEW--";
		echo 'Note attribuée au prof :'.$this->teacherRate;
		echo 'Note attribuéé au cours :'.$this->classRate;
		echo sender->print();
	}
}


