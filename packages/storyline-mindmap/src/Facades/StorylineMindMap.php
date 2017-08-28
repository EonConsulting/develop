<?php
/**
 * Copyright (c) 2016, University of South Africa and/or its affiliates. All rights reserved.
 * DO NOT ALTER OR REMOVE COPYRIGHT NOTICES OR THIS FILE HEADER.
 *
 * This code is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License version 2 only, as
 * published by the Free Software Foundation.
 *
 * This code is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License
 * version 2 for more details (a copy is included in the LICENSE file that
 * accompanied this code).
 *
 * You should have received a copy of the GNU General Public License version
 * 2 along with this work; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/30/2017
 * Time: 12:08 AM
 * @author Peace Ngara <peacengara@aol.com>
 * @category Storyline
 * @package storyline-mindmap
 * @version 1.0.0
 * @since 1.0.0
 */

namespace EONConsulting\Storyline\MindMap\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class StorylineMindMap
 * @package EONConsulting\Storyline\MindMap\Facades
 */
class StorylineMindMap extends Facade {

    protected static function getFacadeAccessor() {
        return 'storyline_mind_map';
    }

}