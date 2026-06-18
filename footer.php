<footer role="contentinfo" class="mt-6 md:my-12">
    <?php Container(function(){ ?>
        <section class="relative bg-[#121212] md:rounded-xl text-white text-sm p-8 overflow-hidden md:text-base xl:p-14">
            <h2 class="sr-only">Informacje o właścicielu</h2>    
            
            <p class="text-[#9C9C9C] font-semibold mb-10 leading-7 max-w-sm xl:text-2xl xl:max-w-lg xl:mb-16 lg:leading-10">
                Jesteśmy oddani zapewnianiu Państwu <span class="text-white">komfortu i świetnych wrażeń</span> podczas pobytu w Zielonej Górze.
            </p>
            
            <address class="space-y-4 xl:space-y-6 not-italic" itemscope itemtype="https://schema.org/Person">
                <?php echo wp_get_attachment_image(80, 'thumbnail', false, [
                    'class' => 'w-[132px] h-[21px] object-contain object-left',
                    'decoding' => 'async',
                    'loading' => 'lazy',
                    'alt' => 'Podpis - Tomasz Stefanowicz' 
                ]); 
                ?>
                <div class="space-y-1">
                    <p itemprop="name">Tomasz Stefanowicz</p>
                    <p itemprop="jobTitle" class="text-xs text-[#9C9C9C]">Właściciel</p>
                </div>
            </address>

            <?php echo wp_get_attachment_image(79, 'medium', false, [
                'class' => 'w-35 sm:w-50 xl:w-60 absolute bottom-0 right-0 pointer-events-none object-contain object-bottom-right',
                'decoding' => 'async',
                'loading' => 'lazy',
                'alt' => '' 
            ]); 
            ?>
        </section>
    <?php }, "!px-0 md:!px-6"); ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>