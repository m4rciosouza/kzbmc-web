<?php
/**
 * Item class, store the items of a Canvas project.
 * 
 * @author marciosouza
 * @property title
 * @property description
 * @property color
 * @property type
 * @property canvas_id
 *
 */
class Item extends Eloquent
{
	const TYPE_PC  = 'pc';
	const TYPE_AC  = 'ac';
	const TYPE_RC  = 'rc';
	const TYPE_PV  = 'pv';
	const TYPE_RCL = 'rcl';
	const TYPE_CA  = 'ca';
	const TYPE_SC  = 'sc';
	const TYPE_EC  = 'ec';
	const TYPE_FR  = 'fr';
}