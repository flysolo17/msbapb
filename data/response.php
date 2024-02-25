<?php

class Response {
  private bool $status;
  private string $message;
  private $data;

  public function __construct(bool $status, string $message = "", $data = null) {
    $this->status = $status;
    $this->message = $message;
    $this->data = $data;
  }

  public function getStatus(): bool {
    return $this->status;
  }

  public function getError(): string {
    return $this->message;
  }

  public function getData() {
    return $this->data;
  }

  public function __toString(): string {
    return json_encode([
      "status" => $this->status,
      "message" => $this->message,
      "data" => $this->data,
    ]);
  }
}

?>