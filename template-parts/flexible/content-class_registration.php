<section class="class-registration">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="registration-form">
                    <div class="registration-intro">
                        <?php the_sub_field('registration_intro'); ?>
                    </div>
                    <div class="registered">
                        <h3>Selected Training:</h3>
                        <p class="trainingdate">
                            <?php
                                $queryURL = parse_url( html_entity_decode( esc_url( add_query_arg( $arr_params ) ) ) );
                                parse_str( $queryURL['query'], $getVar );
                                $classTitle = $getVar['training'];
                                $classDate = $getVar['date'];
                                echo $classTitle . ' <br> ' . $classDate;
                             ?>
                         </p>
                    </div>
                    <?php the_sub_field('registration_form'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
