<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<script>
		window.MathJax = {
			MathML: {
				extensions: ["mml3.js", "content-mathml.js"]
			}
		};
	</script>
	<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>

	<title>HS Anak Panah</title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?= base_url('assets/front-end/plugins/fontawesome-free/css/all.min.css') ?>">
	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/daterangepicker/daterangepicker.css' ?>">
	<!-- SELECT 2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/front-end/dist/css/adminlte.min.css') ?>">
	<!-- Glider -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/plugins/glider/glider.min.css') ?>">
	<!-- ChartJs -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/plugins/chart.js/chart.min.css') ?>">
	<!-- Datepicker -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css">

	<!-- Sweetalert2 -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/plugins/sweetalert2/sweetalert2.min.css') ?>">
	<!-- Ekko Lightbox -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet" crossorigin="anonymous">

	<!-- TOAST -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />
	<!-- Google Font: Source Sans Pro -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

	<!-- My CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/front-end/dist/css/my-css.css') ?>">

	<style>
		blockquote {
			background: #f9f9f9;
			border-left: .2em solid #007bff;
			border-radius: 5px;
			margin: 0px 0px 10px 0px;
			padding: .5em .7rem;
		}
	</style>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
	<div class="wrapper" style="height: 100%;">
