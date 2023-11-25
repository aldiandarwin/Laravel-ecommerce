import { Head } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Container from '@/Components/Container';

export default function Home({ products }) {
    return (
        <>
            <Head title='Welcome to Online Store' />
            <Container>
                <div className='py-8 lg:py-16'>
                    <h2 className='text-2xl font-bold tracking-tight text-gray-900'>Trending Products</h2>
                </div>
            </Container>
        </>
    );
}

Home.layout = (page) => (
    <AppLayout
        header={<h2 className='text-xl font-semibold leading-tight text-gray-800'>Start Shopping</h2>}
        children={page}
    />
);
