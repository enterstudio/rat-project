<?php
/**
 * @package     T.Platform
 * @subpackage  Image
 */

defined('T_PLATFORM') or die;

/**
 * Image Filter class adjust the contrast of an image.
 *
 * @package     T.Platform
 * @subpackage  Image
 * @since       5/2014
 */
class TImageFilterContrast extends JImageFilter
{
	/**
	 * Method to apply a filter to an image resource.
	 *
	 * @param   array  $options  An array of options for the filter.
	 *
	 * @return  void
	 *
	 * @since   5/2014
	 * @throws  InvalidArgumentException
	 * @throws  RuntimeException
	 */
	public function execute(array $options = array())
	{
		// Verify that image filter support for PHP is available.
		if (!function_exists('imagefilter'))
		{
			// @codeCoverageIgnoreStart
			TLog::add('The imagefilter function for PHP is not available.', TLog::ERROR);
			throw new RuntimeException('The imagefilter function for PHP is not available.');

			// @codeCoverageIgnoreEnd
		}

		// Validate that the contrast value exists and is an integer.
		if (!isset($options[IMG_FILTER_CONTRAST]) || !is_int($options[IMG_FILTER_CONTRAST]))
		{
			throw new InvalidArgumentException('No valid contrast value was given.  Expected integer.');
		}

		// Perform the contrast filter.
		imagefilter($this->handle, IMG_FILTER_CONTRAST, $options[IMG_FILTER_CONTRAST]);
	}
}
