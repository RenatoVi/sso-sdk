<?php

use Sso\SsoSdk\Facades\Sso;

it('teste', function () {
    $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZjA1YWNiNDdlY2VmYjRkOGE0ZDI0MzNlOTc5NGQ1YmZhMTVhYjRiMzJmNWJlZGU1NzZhMTY3YzBjMDk2NTI1NzhiMzdmMGI0NmZmZjYyYmUiLCJpYXQiOjE3MjMxNjM1NTkuOTEzNTQsIm5iZiI6MTcyMzE2MzU1OS45MTM1NDIsImV4cCI6MTcyMzI0OTk1OS45MDk3MDYsInN1YiI6IjM3Iiwic2NvcGVzIjpbImJldHM6aW5kZXgiLCJiZXRzOmxpc3QiLCJiZXR0aW5nLXBhbmVsIiwiZGVwb3NpdHM6bGlzdCIsImxpc3QtZGVwb3NpdHMiLCJsaXN0LXVzZXJzIiwibGlzdC13aXRoZHJhd2FscyIsIm5vdGVzOmFkZCIsIm5vdGVzOmxpc3QiLCJyb2xlczpsaXN0Iiwicm9sZXM6bGlzdC5wZXJtaXNzaW9ucyIsInRyYW5zYWN0aW9uczpsaXN0IiwidXNlcnM6YmxvY2suYmV0cyIsInVzZXJzOmJsb2NrLmxvZ2luIiwidXNlcnM6YmxvY2sud2l0aGRyYXdzIiwidXNlcnM6Z2V0LndhbGxldCIsInVzZXJzOmluZGV4IiwidXNlcnM6bGlzdCIsInVzZXJzOmxpc3QuaW5kaWNhdG9ycy5iZXRzIiwidXNlcnM6bGlzdC5pbmRpY2F0b3JzLmNhc2lubyIsIndpdGhkcmF3YWxzOmxpc3QiXX0.H2gXuRwFbQRkQ62NCozIJ2d4VpfpLsIavQ9_HR-I2S2hgHt7J0_ptAuf6VLJxWP52adFuZIhJgtqv2tupeuAY1xMd3nPrhSiHh94gXM83q3bsBkVED_DxNMLjxN2ScZaWaWEOgdu-V5A2yuyJI1pHROvOB9sR2duy7g6x6R4M0arcIpmo_ipJzd6SsDzkYTxDLG-ZwYoGvb9fP9wlHs_CXodA2DxLUXOyI1l7oHBjqcs8i5WAIiMPMEAfT0Uaa0pblvRS6oYM0qp7G8w9WfNVRDesP1bNGqPHMErqTroVoQ0RVwdNtgRYwWgxXX3f0mHtAY374hS0uP4nXNZ3yj7ITcMppOdLGLq8ABSO7hSK1jV21E5RomJfFZ9mqoGJXrCTF7ZM0X1hJ6D1SJcFOEcix19ZJqc-IfRskAl4SN4H5xoBLzCM33nC2wmaSFKfX6p0PWbBBLIEyj_Q2fyTkf1ACfEXIwjI81IQjvGvLvg4rQuJg1XtBryFusMf1_0vdzLKj1h78VuTwgXcHntZUw49z5G_GbMp_8ubxp6ZxIdGJQG0lJAErFjZ2zUFlQ9hT1iRl9OB2HHvLfIjO5b-prVsGAL2-zuNtlCHxl0Pwzgc_ArL27L5FT70B0LDk_D-b4QJXtls6O2dir9FSTyM7HfvFFcHe6t-dafSjFsxcoirPI';
    $res = Sso::user($token, true);
});