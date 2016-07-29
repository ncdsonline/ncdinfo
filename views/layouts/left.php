<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">

                <img src="
                <?php

                    if(Yii::$app->user->isGuest)
                      {
                          echo "uploads/user_photos/guest";
                      }else{

                          echo "uploads/user_photos/".Yii::$app->user->identity->id;
                      }
                      ?>.jpg" height="160" width="160" class="img-circle" alt="User Image"/>
                <br><br><br>
            </div>
            <div class="pull-left info">
                <p><?php
                    if(Yii::$app->user->isGuest)
                      {
                        echo 'Guest';
                        echo "<p>";
                        echo '<a href=index.php?r=site/login><i class="fa fa-lock"></i>&nbsp;&nbsp;เข้าสู่ระบบ</a>';
                        echo "</p>";
                      }else{

                        echo 'ยินดีต้อนรับ :'.'<p>'.'คุณ'. Yii::$app->user->identity->profile->firstname;
                        echo "<br>";
                      //  echo 'รหัสหน่วยบริการ :'. Yii::$app->user->identity->profile->chospital->hospnamenew;
                        echo "</p>";
                       // echo "<hr>";
                        
                        echo "<p>";
                        echo '<a href=index.php?r=site/logout><i class="fa fa-sign-out"></i>&nbsp; ออกจากระบบ</a>';
                         echo "<hr>";
                      
                        // echo "<hr>";
                      }?></p>
                
          
              <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>

        <!-- search form -->

        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [

                    ['label' => 'สมัครสมาชิก',   'icon' => 'fa fa-sign-in','url' => ['/site/signup'],'visible'=>Yii::$app->user->isGuest],
                  //  ['label' => 'เมนู', 'options' => ['class' => 'header']],
					
                    ['label' => 'Home',   'icon' => 'fa fa-home','url' => ['/site/index']],
                                    ['label' => 'ประชากรจากการสำรวจ',  
						'url' => ['#'],
						'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
						'items' => [
							['label' => 'จำแนกตามกลุ่มอายุ',   'icon' => 'fa fa-male', 'url' => ['/target-by-age-group/index']],
							['label' => 'ค้นหาจากอายุ',   'icon' => 'fa fa-male', 'url' => ['/target-find-by-age/index']],
							['label' => 'ค้นหาจากวันเกิด',   'icon' => 'fa fa-male', 'url' => ['/target-find-by-birth/index']],
														
						],
					],
                                        ['label' => 'ทะเบียนโรคเรื้อรัง',  
						'url' => ['#'],
						'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
						'items' => [
							
							['label' => 'Diabetes',   'icon' => 'fa fa-tint', 'url' => ['/diabetes-registed/index']],
							['label' => 'Hypertension',   'icon' => 'fa fa-stethoscope', 'url' => ['/hypertension-registed/index']],								
						],
					],
					['label' => 'ความชุกโรคเรื้อรัง',  
						'url' => ['#'],
						'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
						'items' => [
							
							['label' => 'Diabetes',   'icon' => 'fa fa-tint', 'url' => ['/dm/index']],
							['label' => 'Hypertension',   'icon' => 'fa fa-stethoscope', 'url' => ['/ht/index']],
                                                        ['label' => 'HT with DM',   'icon' => 'fa fa-heartbeat', 'url' => ['/ht/index']],
                                                        ['label' => 'Other Chronics',   'icon' => 'fa fa-bed', 'url' => ['/chronicsprevalence/index']],
						],
					],
					
					['label' => 'โรคเรื้อรังรายใหม่',  
						'url' => ['#'],
						'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
						'items' => [
							['label' => 'Diabetes',   'icon' => 'fa fa-tint','url' => ['/diabetes-newcase/index']],
							['label' => 'Hypertension',   'icon' => 'fa fa-stethoscope','url' => ['/hypertension-newcase/index']],
                                                        ['label' => 'Unregisted',   'icon' => 'fa fa-folder-open','url' => ['/chronic-unregisted/index']],
						],
					],
                                        ['label' => 'การคัดกรองโรคเรื้อรัง',  
						'url' => ['#'],
						'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
						'items' => [
                                                       
							['label' => 'Diabetes',   'icon' => 'fa fa-tint','url' => ['/screendiabetes/index']],
							['label' => 'Hypertension',   'icon' => 'fa fa-stethoscope ','url' => ['/screenhypertension/index']],
                                                        ['label' => 'Screening',   'icon' => 'fa fa-filter','url' => ['/screenncd/index']],
						],
					],

                   
					
					['label' => 'การปรับพฤติกรรมกลุ่มเสี่ยง',  
						'url' => ['#'],
						'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
						'items' => [
							['label' => 'Prediabetes',   'icon' => 'fa fa-bicycle', 'url' => ['/prediabetes/index']],
							['label' => 'Prehypertension',   'icon' => 'fa fa-bicycle', 'url' => ['/prehypertension/index']],	
						],
					],
//					['label' => 'ภาวะแทรกซ้อนในผู้ป่วย',    'url' => ['#']],
//                                        ['label' => 'ประวัติการ Admit',    'url' => ['#']],
					['label' => 'การตรวจทางห้องปฏิบัติการ',  
						'url' => ['#'],
						'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
						'items' => [
                                                        ['label' => 'จองคิวส่งตรวจแล็ป',   'icon' => 'fa fa-medkit', 'url' => ['/lab-test-booking/index']],
							['label' => 'ค้นหาประวัติการตรวจแล็ป',   'icon' => 'fa fa-search', 'url' => ['#']],
						],
					],
					['label' => 'การตรวจแล็ปประจำปี',  
						'url' => ['#'],
						'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
						'items' => [
                                                        ['label' => 'การเข้าถึงบริการ',   'icon' => 'fa fa-ambulance', 'url' => ['/lab-delivery/index']],
							['label' => 'lipid profile',   'icon' => 'fa fa-tint', 'url' => ['#']],
                                                        ['label' => 'HbA1C',   'icon' => 'fa fa-flask', 'url' => ['#']],
						],
					],
					
					['label' => 'การเยี่ยมบ้าน',    'url' => ['#']],
                                       
                    
                        ['label' => 'การประเมินผลการดูแลรักษา',
                        // 'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [                          
                            ['label' => 'Diabetes', 'icon' => 'fa fa-circle-o', 'url' => ['/dm-outcomes/index'],],
                            [
                                'label' => 'Hypertension',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Hypertension Only', 'icon' => 'fa fa-circle-o', 'url' => ['/ht-outcomes/index'],],
                                    ['label' => 'Hypertension with Diabetes ', 'icon' => 'fa fa-circle-o', 'url' => ['/ht-dm-outcomes/index'],],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'fa fa-circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                        ],
//                                    ],
                                ],
                            ],
                        ],
                        
                    ],
                    ['label' => 'เกี่ยวกับตัวชี้วัด',    'url' => ['#']],
					
                    
                  //  ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                //    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],

                    //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                    /* /*  begin multi level 
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [

                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                 */ /* -- end multi level */
                ],
            ]
        ) ?>

    </section>

</aside>
