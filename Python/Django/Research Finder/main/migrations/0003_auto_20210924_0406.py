# Generated by Django 3.2.7 on 2021-09-24 04:06

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('main', '0002_auto_20210924_0406'),
    ]

    operations = [
        migrations.AlterField(
            model_name='article',
            name='title',
            field=models.CharField(max_length=400),
        ),
        migrations.AlterField(
            model_name='researcher',
            name='name',
            field=models.CharField(max_length=400),
        ),
        migrations.AlterField(
            model_name='university',
            name='name',
            field=models.CharField(max_length=400),
        ),
    ]