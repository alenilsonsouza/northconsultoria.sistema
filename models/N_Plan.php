<?php
class N_Plan
{
    private $product;
    private $price;
    private $image;
    private $text;
    private $active;
    private $accreditedNetwork;
    private $cover;
    private $due_day;
    private $effective_day;
    private $cutting_day;

    public function setProduct(string $product)
    {
        $this->product = $product;
    }
    public function setPrice(float $price)
    {
        $this->price = $price;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function setText(string $text)
    {
        $this->text = $text;
    }
    public function setActive(string $active)
    {
        $this->active = $active;
    }
    public function setAccreditedNetWork(string $accreditedNetwork) {
        $this->accreditedNetwork = $accreditedNetwork;
    }
    public function setCover($cover) {
        $this->cover = $cover;
    }
    public function setDueDay($due_day) {
        $this->due_day = $due_day;
    }
    public function setEffectiveDay($effective_day) {
        $this->effective_day = $effective_day;
    }
    public function setCuttingDay($cutting_day) {
        $this->cutting_day = $cutting_day;
    }

    public function getProduct()
    {
         return $this->product;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getText()
    {
        return $this->text;
    }
    public function getActive()
    {
        return $this->active;
    }
    public function getAccreditedNetwork() {
        return $this->accreditedNetwork;
    }
    public function getCover() {
        return $this->cover;
    }
    public function getDueDay() {
        return $this->due_day;
    }
    public function getEffectiveDay() {
        return $this->effective_day;
    }
    public function getCuttingDay() {
        return $this->cutting_day;
    }
}
