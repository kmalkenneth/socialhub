import { sveltekit } from '@sveltejs/kit/vite';
import type { UserConfig } from 'vite';

const config: UserConfig = {
	define: {
		'import.meta.vitest': 'undefined'
	},
	test: {
		includeSource: ['src/**/*.{js,ts}']
	},
	plugins: [sveltekit()]
};

export default config;
