#!/usr/bin/env perl

use warnings;
use strict;
use Module::Build;
use IO::File;

my $build=Module::Build->new(
	module_name => 'Aftertaste',
	dist_version => '1',
	license => 'perl',
	dist_abstract => 'AfterTaste: little Restaurant project',
	dist_author => 'Nicolas Tremblay <ns.tremblay@gmail.com>',
	requires =>{
		'Carp' => 0,
		'perl' => '5.10.0',
		'Parallel::ForkManager' => 0,
		'Log::Log4perl' => 0,
		'FindBin' => 0,
		'IO::File' => 0,
		'File::Copy' => 0,
		'Role::Tiny' => 0,
		'Bio::SeqIO' => 0,
		'Bio::DB::Fasta' => 0,
		'File::Temp' => 0,
		'Bio::Seq' => 0,
		'File::Basename'=>0,
		'Tie::Log4perl'=>0,
		'Archive::Zip'=>0,
		'Test::Pretty'=>0,
		'Getopt::Long'=>0,
		'Digest::MD5'=>0
	}
);
$build->create_build_script();