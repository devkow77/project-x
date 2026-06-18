<?php get_header(); ?>

<main>
    <?php Container(function(){ ?>
        <!-- NAVIGACJA -->
        <div class="mt-30 space-y-4 md:mt-40">
            <h1 class="text-[#232323] text-3xl sm:text-4xl lg:text-5xl font-bold text-center">Apartamenty</h1>
            <div class="flex items-center justify-center gap-x-2 text-xs tracking-widest">
                <a href="/" class="text-[#6E6E6E]">Home</a>
                <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 18L20.6464 12.3536C20.8417 12.1583 20.8417 11.8417 20.6464 11.6464L15 6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 12L3 12" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                <a href="/apartamenty">Apartamenty</a>
            </div>
        </div>
        <!-- HERO -->
        <div class="relative bg-black/20 aspect-video max-h-100 w-full flex justify-center items-center md:rounded-xl text-center">
            <p class="text-xl tracking-widest">Podstrona w trakcie tworzenia..</p>
        </div>
    <?php }, "!px-0 space-y-6 md:!px-6 md:space-y-12"); ?>
</main>

<?php get_footer(); ?>
