<?php

function customDateToString($timestamp): string
{
  if ($timestamp != null) {
    return date("d F Y  H:i", $timestamp);
  }
  return "Welcome in dashboard page!!!";
}