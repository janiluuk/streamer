<?php
/**
 * PHP Reader Library
 *
 * Copyright (c) 2008 The PHP Reader Project Workgroup. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *  - Neither the name of the project workgroup nor the names of its
 *    contributors may be used to endorse or promote products derived from this
 *    software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    php-reader
 * @subpackage ASF
 * @copyright  Copyright (c) 2008 The PHP Reader Project Workgroup
 * @license    http://code.google.com/p/php-reader/wiki/License New BSD License
 * @version    $Id: TimecodeIndexParameters.php 23 2010-05-20 19:36:28Z cloneui $
 */

/**#@+ @ignore */
require_once("ASF/Object.php");
/**#@-*/

/**
 * The <i>Timecode Index Parameters Object</i> supplies information about those
 * streams that are actually indexed (there must be at least one stream in an
 * index) by timecodes. All streams referred to in the
 * {@link ASF_Object_TimecodeIndexParameters Timecode Index Parameters Object}
 * must have timecode Payload Extension Systems associated with them in the
 * {@link ASF_Object_ExtendedStreamProperties Extended Stream Properties
 * Object}. This object shall be present in the {@link ASF_Object_Header Header
 * Object} if there is a {@link ASF_Object_TimecodeIndex Timecode Index Object}
 * present in the file.
 * 
 * An Index Specifier is required for each stream that will be indexed by the
 * {@link ASF_Object_TimecodeIndex Timecode Index Object}. These specifiers must
 * exactly match those in the {@link ASF_Object_TimecodeIndex Timecode Index
 * Object}.
 *
 * @package    php-reader
 * @subpackage ASF
 * @author     Sven Vollbehr <svollbehr@gmail.com>
 * @copyright  Copyright (c) 2008 The PHP Reader Project Workgroup
 * @license    http://code.google.com/p/php-reader/wiki/License New BSD License
 * @version    $Rev: 23 $
 */
final class ASF_Object_TimecodeIndexParameters extends ASF_Object
{
  /** @var string */
  private $_indexEntryCountInterval;
  
  /** @var Array */
  private $_indexSpecifiers = array();
  
  /**
   * Constructs the class with given parameters and reads object related data
   * from the ASF file.
   *
   * @param Reader $reader  The reader object.
   * @param Array  $options The options array.
   */
  public function __construct($reader, &$options = array())
  {
    parent::__construct($reader, $options);
    
    $this->_indexEntryCountInterval = $this->_reader->readUInt32LE();
    $indexSpecifiersCount = $this->_reader->readUInt16LE();
    for ($i = 0; $i < $indexSpecifiersCount; $i++) {
      $this->_indexSpecifiers[] = array
        ("streamNumber" => $this->_reader->readUInt16LE(),
         "indexType" => $this->_reader->readUInt16LE());
    }
  }
  
  /**
   * Returns the interval between each index entry by the number of media
   * objects. This value cannot be 0.
   *
   * @return integer
   */
  public function getIndexEntryCountInterval()
  {
    return $this->_indexEntryCountInterval;
  }
  
  /**
   * Returns an array of index entries. Each entry consists of the following
   * keys.
   * 
   *   o streamNumber -- Specifies the stream number that the Index Specifiers
   *     refer to. Valid values are between 1 and 127.
   * 
   *   o indexType -- Specifies the type of index. Values are defined as
   *     follows:
   *       2 = Nearest Past Media Object,
   *       3 = Nearest Past Cleanpoint (1 is not a valid value).
   *     For a video stream, The Nearest Past Media Object indexes point to the
   *     closest data packet containing an entire video frame or the first
   *     fragment of a video frame, and the Nearest Past Cleanpoint indexes
   *     point to the closest data packet containing an entire video frame (or
   *     first fragment of a video frame) that is a key frame. Nearest Past
   *     Media Object is the most common value.
   *
   * @return Array
   */
  public function getIndexSpecifiers() { return $this->_indexSpecifiers; }
}
