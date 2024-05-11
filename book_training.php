<?php
 include("session-timeout.php"); 
 ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h3 style="text-align: center;"><bold>TRAINING TIMETABLE</bold></h3>
<table>
    <br>
  <thead>
    <tr>
      <th>Days</th>
      <th>9am - 10am</th>
      <th>10am - 11am</th>
      <th>11am - 12pm</th>
      <th>4pm - 5pm</th>
      <th>5pm - 6pm</th>
      <th>6pm - 7pm</th>
      <th>7pm - 8pm</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Saturday</td>
      <td>Learn to swim</td>
      <td>Intermediate/learn to swim</td>
      <td>Junior squad training ages 7-9</td>
      <td></td>
      <td>Senior squad training ages 10-16</td>
      <td></td>
      <td>Ladies Swimming</td>
    </tr>
    <tr>
      <td>Sunday</td>
      <td></td>
      <td></td>
      <td></td>
      <td>Intermediate/learn to swim</td>
      <td>Junior Squad ages 7-10</td>
      <td>Intermediate Learn to swim</td>
      <td>Senior squad Ages 11-16</td>
    </tr>
    <tr>
      <td>Monday</td>
      <td>Junior squad Stroke 7-9 training / Learn to swim/Intermediate</td>
      <td>Junior squad 5-7</td>
      <td>Intermediate/learn to swim</td>
      <td></td>
      <td>Senior squad Ages 10-16</td>
      <td>Intermediate Learn to swim</td>
      <td>Ladies classes</td>
    </tr>
    <tr>
      <td>Tuesday</td>
      <td>Junior Ages 6-8</td>
      <td>Intermediate/ Learn to swim 1 Learn to swim 2</td>
      <td>Junior squad Ages 8-12</td>
      <td>Intermediate Learn to swim</td>
      <td>Senior Squad: Ages 12-16</td>
      <td>Learn to swim Intermediate</td>
      <td>Triathlon and Adult classes Male</td>
    </tr>
    <tr>
      <td>Wednesday</td>
      <td>Juniors Squad 6-8yrs</td>
      <td>Intermediate Learn to swim</td>
      <td>Senior Ages 9-12</td>
      <td>Intermediate Learn to swim</td>
      <td>Senior squad Ages 12-16</td>
      <td>Intermediate Learn to swim</td>
      <td>Ladies classes</td>
    </tr>
  </tbody>
</table>
    <style>
      body {
        font-family: Arial, sans-serif;
        font-size: 14px;
        /*background-color: #2596be;*/
      }
      table {
        border-collapse: collapse;
        width: 100%;
      }
      th,
      td {
        padding: 10px;
        text-align: left;
        vertical-align: top;
        border: 1px solid #ddd;
      }
      th {
        background-color: #f2f2f2;
        font-weight: bold;
        font-size: 16px;
      }
      td:first-child {
        font-weight: bold;
        width: 100px;
      }
      td.bold {
        font-weight: bold;
      }
      .row {
        display: flex;
        flex-wrap: wrap;
      }
      .col {
        width: 25%;
        padding: 5px;
      }
      @media (max-width: 768px) {
        .col {
          width: 50%;
        }
      }
      @media (max-width: 480px) {
        td:first-child {
          width: 80px;
        }
        .col {
          width: 100%;
        }
      }
    </style>
</body>
</html>