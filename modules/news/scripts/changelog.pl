#!/usr/bin/perl -w

## General information.
#
# File name:   convert-docs.pl
# Last update: Thu Dec  8 15:06:28 2005
#
##

## Bugreports and License disclaimer.
#
# For bugreports and other improvements contact The Irssi Project <staff@irssi.org>
#
#    This program is free software; you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation; either version 2 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this script; if not, write to the Free Software
#    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
##

## Original script by Wouter Coekaerts.

##
# This script will convert the NEWS file to html.
##

use strict;
use warnings;
use LWP::Simple;
use FindBin qw($RealBin);

$RealBin =~ s|modules/news/scripts|tmp|g;

## input
my $temp = get("http://svn.irssi.org/repos/irssi/trunk/NEWS");

open(G, ">$RealBin/news.tmp");
    print G $temp;
close(G);

my @newslines = `cat $RealBin/news.tmp`;
my ($linenr, $line) = (0, "");

sub nextline {
	$line = $newslines[$linenr];
	chomp $line;
	$linenr++;
	return $line;
}

## output
open(F, ">". $RealBin ."/changelog.page");
print F "<div id=\"content\">";

## convert
my $currentpart = ''; # '*'=summary | '+'=features | '-'=bugs
nextline;
my ($version, $date) = ($line =~ /^v(\d+\.\d+\.\d+) (....-..-..) /);
print F "<h1>ChangeLog for $version</h1>\n";
nextline;
while (defined($line) && $line !~ /^v/) {
	# skip empty lines
	if ($line =~ /^ *$/) { nextline; next;};
	
	# remove first tab
	$line =~ s/\t(.)//;
	
	# headers for different parts
	if ($currentpart ne $1) { # new part
		if ($1 eq '*') {
			print F "<ul>\n";
		} elsif ($1 eq '+') {
			print F "</ul><h2>Features:</h2><ul>\n";
		} elsif ($1 eq '-') {
			print F "</ul><h2>Bugfixes:</h2><ul>\n";
		}
	}
	$currentpart = $1;
	
	# items
	print F "<li>";
	my $insublist = 0;
	do {
		# empty line
		if ($line eq '') {
			print F "<br />\n";
		} else {
		
			#sublist
			if ($line =~ s/^[+-] //) {
				if (! $insublist) {
					print F "\n <ul>\n  <li>";
					$insublist = 1;
				} else {
					print F "</li>\n  <li>";
				}
			}
			
			# TODO: escape all html stuff
			$line =~ s/&/&amp;/;
			$line =~ s/</&lt;/;
			$line =~ s/>/&gt;/;
			$line =~ s|(bug )(\d+)|$1.buglink($2)|eig;
			$line =~ s|(bugs )(\d+)( and )(\d+)|$1.buglink($2).$3.buglink($4)|eig;
			print F $line;
			print F " ";
		}
		
		nextline;
	} while ($line eq '' || $line =~ s/\t +//);
	if ($insublist) {
		print F "</li>\n </ul>\n";
	}
	print F "</li>\n";
}
print F "</ul></div>";
close(F);

sub buglink {
	my ($n) = @_;
	return "<a href=\"http://bugs.irssi.org/?do=details&amp;id=$n\">$n</a>";
}
