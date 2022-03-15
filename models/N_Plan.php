<?php
class N_Plan
{
    private $product;
    private $price;
    private $image;
    private $text;
    private $active;

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
}
